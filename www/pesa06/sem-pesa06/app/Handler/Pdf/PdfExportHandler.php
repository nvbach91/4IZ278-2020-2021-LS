<?php
declare(strict_types=1);

namespace App\Handler\Pdf;


use App\Domain\Enum\DocumentTypeEnum;
use App\Handler\Pdf\Exception\PdfExportHandlerException;
use Domain\Entity\DocumentEntity;
use Domain\Entity\MemberEntity;
use Domain\Repository\DocumentRepository;
use Domain\Repository\MemberRepository;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Latte\Engine;
use Mpdf\Mpdf;
use Rikudou\CzQrPayment\Options\QrPaymentOptions;
use Rikudou\CzQrPayment\QrPayment;
use Rikudou\Iban\Iban\CzechIbanAdapter;
use Rikudou\Iban\Iban\IBAN;

class PdfExportHandler
{
    private DocumentRepository $documentRepository;
    private Engine $latte;
    private MemberRepository $memberRepository;
    private string $bankNumber;
    private string $bankAccountNumber;

    public function __construct(
        string $bankAccountNumber,
        string $bankNumber,
        DocumentRepository $documentRepository,
        Engine $latte,
        MemberRepository $memberRepository
    ) {
        $this->documentRepository = $documentRepository;
        $this->latte = $latte;
        $this->memberRepository = $memberRepository;
        $this->bankAccountNumber = $bankAccountNumber;
        $this->bankNumber = $bankNumber;
    }

    public function handle(int $documentId): void
    {
        /** @var DocumentEntity|null $document */
        $document = $this->documentRepository->find($documentId);
        if ($document === null) {
            throw new PdfExportHandlerException('Dokument nenalezen!');
        }
        switch ($document->getType()) {
            case DocumentTypeEnum::FAKTURA:
                $this->exportFaktura($document);
                break;
            case DocumentTypeEnum::PRISPEVKY:
                $this->exportPrispevky($document);
                break;
            case DocumentTypeEnum::PRIJATA_FAKTURA:
                $this->exportPrijataFaktura($document);
                break;
            default:
                throw new PdfExportHandlerException('Tento typ dokumentu nebyl implementován.');
        }
    }

    private function exportPrijataFaktura(DocumentEntity $documentEntity): void
    {
        /** @var MemberEntity|null $member */
        $member = $this->memberRepository->find($documentEntity->getMemberId());
        if ($member === null) {
            throw new PdfExportHandlerException('Člen nenalezen.');
        }
        $mpdf = new Mpdf(['tempDir' => __DIR__ . '../../../temp/mPDF']);
        $mpdf->WriteHTML($this->latte->renderToString(__DIR__ . '/template/prijataFaktura.latte', [
            'name' => $member->getFirstName(),
            'surname' => $member->getLastName(),
            'amount' => $documentEntity->getAmount(),
            'created' => $documentEntity->getCreated()->format('d. m. Y'),
            'createdBy' => $documentEntity->getCreatedBy(),
            'facrId' => $member->getFacrId(),
            'accountNumber' => $this->bankAccountNumber . '/' . $this->bankNumber,
        ]));
        $mpdf->Output('Přijatá faktura', 'I');
    }

    private function exportFaktura(DocumentEntity $documentEntity): void
    {
        /** @var MemberEntity|null $member */
        $member = $this->memberRepository->find($documentEntity->getMemberId());
        if ($member === null) {
            throw new PdfExportHandlerException('Člen nenalezen.');
        }
        $qrCode = new QrPayment(new CzechIbanAdapter($this->bankAccountNumber, $this->bankNumber), [
            QrPaymentOptions::VARIABLE_SYMBOL => $member->getFacrId(),
            QrPaymentOptions::AMOUNT => (int)round($documentEntity->getAmount(), 0),
            QrPaymentOptions::CURRENCY => 'CZK',
            QrPaymentOptions::DUE_DATE => $documentEntity->getCreated()->add(new \DateInterval('P14D')),
            QrPaymentOptions::PAYEE_NAME => $member->getFirstName() . ' ' . $member->getLastName(),
            QrPaymentOptions::COMMENT => 'Faktura pro ' . $member->getFirstName() . ' ' . $member->getLastName(),
        ]);

        $img = $qrCode->getQrImage();
        $img->setSize(500);
        $writer = new PngWriter();
        $mpdf = new Mpdf(['tempDir' => __DIR__ . '../../../temp/mPDF']);
        $mpdf->WriteHTML($this->latte->renderToString(__DIR__ . '/template/faktura.latte', [
            'name' => $member->getFirstName(),
            'surname' => $member->getLastName(),
            'amount' => $documentEntity->getAmount(),
            'created' => $documentEntity->getCreated()->format('d. m. Y'),
            'createdBy' => $documentEntity->getCreatedBy(),
            'facrId' => $member->getFacrId(),
            'accountNumber' => $this->bankAccountNumber . '/' . $this->bankNumber,
            'qrImage' => $writer->write($img)->getString(),
        ]));
        $mpdf->Output('Faktura', 'I');
    }

    private function exportPrispevky(DocumentEntity $documentEntity): void
    {
        /** @var MemberEntity|null $member */
        $member = $this->memberRepository->find($documentEntity->getMemberId());
        if ($member === null) {
            throw new PdfExportHandlerException('Člen nenalezen.');
        }
        if ((int)$documentEntity->getCreated()->format('m') < 7) {
            $time = 'Jaro ' . $documentEntity->getCreated()->format('Y');
        } else {
            $time = 'Podzim ' . $documentEntity->getCreated()->format('Y');
        }
        $qrCode = new QrPayment(new CzechIbanAdapter($this->bankAccountNumber, $this->bankNumber), [
            QrPaymentOptions::VARIABLE_SYMBOL => $member->getFacrId(),
            QrPaymentOptions::AMOUNT => (int)round($documentEntity->getAmount(), 0),
            QrPaymentOptions::CURRENCY => 'CZK',
            QrPaymentOptions::DUE_DATE => $documentEntity->getCreated()->add(new \DateInterval('P14D')),
            QrPaymentOptions::PAYEE_NAME => $member->getFirstName() . ' ' . $member->getLastName(),
            QrPaymentOptions::COMMENT => 'Příspěvky ' . $member->getFirstName() . ' ' . $member->getLastName() . ' ' . $time,
        ]);

        $img = $qrCode->getQrImage();
        $img->setSize(500);
        $writer = new PngWriter();
        $mpdf = new Mpdf(['tempDir' => __DIR__ . '../../../temp/mPDF']);
        $mpdf->WriteHTML($this->latte->renderToString(__DIR__ . '/template/prispevky.latte', [
            'name' => $member->getFirstName(),
            'surname' => $member->getLastName(),
            'amount' => $documentEntity->getAmount(),
            'created' => $documentEntity->getCreated()->format('d. m. Y'),
            'createdBy' => $documentEntity->getCreatedBy(),
            'time' => $time,
            'facrId' => $member->getFacrId(),
            'accountNumber' => $this->bankAccountNumber . '/' . $this->bankNumber,
            'qrImage' => $writer->write($img)->getString(),
        ]));
        $mpdf->Output('Faktura', 'I');
    }
}