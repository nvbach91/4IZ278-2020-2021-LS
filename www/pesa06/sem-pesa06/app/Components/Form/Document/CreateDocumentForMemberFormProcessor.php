<?php
declare(strict_types=1);

namespace App\Components\Form\Document;


use App\Components\Form\Document\Exception\CreateDocumentForMemberFormException;
use App\Service\Email\EmailService;
use Domain\Entity\DocumentEntity;
use Domain\Entity\MemberEntity;
use Domain\Repository\DocumentRepository;
use Domain\Repository\MemberRepository;
use Nette\Application\UI\Form;
use Nette\Security\User;

class CreateDocumentForMemberFormProcessor
{
    private MemberRepository $memberRepository;
    private User $user;
    private DocumentRepository $documentRepository;
    private EmailService $emailService;

    public function __construct(
        MemberRepository $memberRepository,
        User $user,
        DocumentRepository $documentRepository,
        EmailService $emailService
    ) {
        $this->memberRepository = $memberRepository;
        $this->user = $user;
        $this->documentRepository = $documentRepository;
        $this->emailService = $emailService;
    }


    public function process(Form $form): int
    {
        $values = $form->getValues();
        /** @var MemberEntity|null $member */
        $member = $this->memberRepository->find((int)$values[CreateDocumentForMemberFormFactory::MEMBER]);
        if ($member === null) {
            throw new CreateDocumentForMemberFormException('Člen nebyl nalezen!');
        }
        $document = new DocumentEntity();
        $document->setType($values[CreateDocumentForMemberFormFactory::DOCUMENT_TYPE]);
        $document->setMemberId($member->getId());
        $document->setAmount((float)$values[CreateDocumentForMemberFormFactory::AMOUNT]);
        $document->setCreatedBy($this->user->getIdentity()->getData()['username']);
        $this->documentRepository->persist($document);
        if ($values[CreateDocumentForMemberFormFactory::SEND_TO_MAIL]) {
            if ($member->getEmail() === null) {
                throw new CreateDocumentForMemberFormException('Tento člen nemá email!');
            }
            $this->emailService->sendDocument($values[CreateDocumentForMemberFormFactory::DOCUMENT_TYPE] . ' pro ' . $member->getFirstName() . ' ' . $member->getLastName(),
                'document.latte', $member->getEmail(), $document->getId(), ['name' => $member->getFirstName() . ' ' . $member->getLastName()]);
        }
        return $document->getId();
    }
}