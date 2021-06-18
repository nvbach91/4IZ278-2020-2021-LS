<?php
declare(strict_types=1);

namespace App\Service\Email;


use App\Domain\Enum\EmailRecipientEnum;
use App\Handler\Pdf\PdfExportHandler;
use Domain\Repository\MemberRepository;
use App\Service\Email\Exception\EmailServiceException;
use Latte\Engine;
use Nette\Mail\Message;
use Nette\Mail\SmtpMailer;

class EmailService
{
    private SmtpMailer $mailer;
    private MemberRepository $memberRepository;
    private Engine $latte;
    private PdfExportHandler $pdfExportHandler;

    public function __construct(
        array $mailerData,
        MemberRepository $memberRepository,
        Engine $latte,
        PdfExportHandler $pdfExportHandler
    ) {
        $this->mailer = new SmtpMailer($mailerData);
        $this->memberRepository = $memberRepository;
        $this->latte = $latte;
        $this->pdfExportHandler = $pdfExportHandler;
    }

    public function sendMail(string $title, string $text, string $recipient, int $teamId = null): void
    {
        $mail = new Message();
        $mail->setSubject($title);
        $mail->setHtmlBody($text);
        $emptyRecipients = true;
        foreach ($this->findRecipientAddresses($recipient, $teamId) as $key => $value){
            $emptyRecipients = false;
            $mail->addTo($value);
        }
        if ($emptyRecipients === true) {
            throw new EmailServiceException('No recipients found!');
        }
        $mail->setFrom('cechiedubecapp@gmail.com');
        $this->mailer->send($mail);

    }

    public function sendFromTemplate(string $title, string $templateName, string $recipient, array $params = []): void
    {
        $mail = new Message();
        $mail->setSubject($title);
        $mail->setHtmlBody($this->latte->renderToString(__DIR__ . '/template/' . $templateName, $params));
        $mail->addTo($recipient);
        $mail->setFrom('cechiedubecapp@gmail.com');
        $this->mailer->send($mail);
    }

    public function sendDocument(string $title, string $templateName, string $recipient, int $documentId, array $params = []): void
    {
        $mail = new Message();
        $mail->setSubject($title);
        $mail->setHtmlBody($this->latte->renderToString(__DIR__ . '/template/' . $templateName, $params));
        $mail->addTo($recipient);
        $mail->setFrom('cechiedubecapp@gmail.com');
        ob_start();
        $this->pdfExportHandler->handle($documentId);
        $output = ob_get_contents();
        $mail->addAttachment('priloha.pdf', $output);
        ob_end_clean();
        $this->mailer->send($mail);
    }

    private function findRecipientAddresses(string $recipient, int $teamId = null): array
    {
        switch ($recipient) {
            case EmailRecipientEnum::GLOBAL:
                return $this->memberRepository->getAllEmails();
            case EmailRecipientEnum::TEAM:
                if ($teamId === null) {
                    throw new EmailServiceException('Please select team!');
                }
                return $this->memberRepository->getMailsByTeamId($teamId);
            case EmailRecipientEnum::ACTIVE_PLAYERS:
                return $this->memberRepository->getActivePlayerMails();
            case EmailRecipientEnum::STAFF:
                return $this->memberRepository->getStaffMails();
            default:
                throw new EmailServiceException('Not implemented yet');
        }

    }
}