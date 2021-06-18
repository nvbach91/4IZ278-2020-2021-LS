<?php
declare(strict_types=1);

namespace App\Components\Form\Document;


use App\Components\Form\Document\Exception\CreateDocumentForMemberFormException;
use App\Service\Email\EmailService;
use Domain\Entity\DocumentEntity;
use Domain\Entity\MemberEntity;
use Domain\Entity\PlayerEntity;
use Domain\Repository\DocumentRepository;
use Domain\Repository\MemberRepository;
use Domain\Repository\PlayerRepository;
use Nette\Application\UI\Form;
use Nette\Security\User;

class CreateDocumentForTeamFormProcessor
{
    private PlayerRepository $playerRepository;
    private DocumentRepository $documentRepository;
    private User $user;
    private EmailService $emailService;
    private MemberRepository $memberRepository;

    public function __construct(
        PlayerRepository $playerRepository,
        DocumentRepository $documentRepository,
        User $user,
        EmailService $emailService,
        MemberRepository $memberRepository
    ) {
        $this->playerRepository = $playerRepository;
        $this->documentRepository = $documentRepository;
        $this->user = $user;
        $this->emailService = $emailService;
        $this->memberRepository = $memberRepository;
    }

    public function process(Form $form): void
    {
        $values = $form->getValues();
        $players = $this->playerRepository->findActiveByTeamId((int)$values[CreateDocumentForTeamFormFactory::TEAM]);
        /** @var PlayerEntity $player */
        foreach ($players as $player) {
            /** @var MemberEntity|null $member */
            $member = $this->memberRepository->find($player->getMemberId());
            $document = new DocumentEntity();
            $document->setType($values[CreateDocumentForTeamFormFactory::DOCUMENT_TYPE]);
            $document->setMemberId($player->getMemberId());
            $document->setAmount((float)$values[CreateDocumentForTeamFormFactory::AMOUNT]);
            $document->setCreatedBy($this->user->getIdentity()->getData()['username']);
            $this->documentRepository->persist($document);
            if ($values[CreateDocumentForTeamFormFactory::SEND_TO_MAIL]) {
                if ($member === null) {
                    continue;
                }
                if ($member->getEmail() === null) {
                    continue;
                }
                $this->emailService->sendDocument($values[CreateDocumentForMemberFormFactory::DOCUMENT_TYPE] . ' pro ' . $member->getFirstName() . ' ' . $member->getLastName(),
                    'document.latte', $member->getEmail(), $document->getId(), ['name' => $member->getFirstName() . ' ' . $member->getLastName()]);
            }
        }
    }
}