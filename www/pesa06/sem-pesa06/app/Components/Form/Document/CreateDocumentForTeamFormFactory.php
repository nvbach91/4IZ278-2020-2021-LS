<?php
declare(strict_types=1);

namespace App\Components\Form\Document;


use App\Domain\Enum\DocumentTypeEnum;
use Domain\Repository\TeamRepository;
use Nette\Application\UI\Form;

class CreateDocumentForTeamFormFactory
{
    public const AMOUNT = 'amount';
    public const DOCUMENT_TYPE = 'document_type';
    public const TEAM = 'team';
    public const SEND_TO_MAIL = 'send_to_mail';


    private CreateDocumentForTeamFormProcessor $processor;
    private TeamRepository $teamRepository;

    public function __construct(
        CreateDocumentForTeamFormProcessor $processor,
        TeamRepository $teamRepository
    ) {
        $this->processor = $processor;
        $this->teamRepository = $teamRepository;
    }

    public function create(): Form
    {
        $form = new Form();
        $form->addSelect(self::DOCUMENT_TYPE, 'Typ dokumentu', DocumentTypeEnum::getValues());
        $form->addSelect(self::TEAM, 'Příjemce (tým)', $this->teamRepository->fetchPairs('id', 'name'));
        $form->addText(self::AMOUNT, 'Částka');
        $form->addCheckbox(self::SEND_TO_MAIL, 'Poslat na mail');
        $form->addSubmit('submit', 'Odeslat');
        $form->onSuccess[] = function (Form $form) {
            $this->processor->process($form);
            $form->getPresenter()->redirect('Document:default');
        };
        return $form;
    }
}