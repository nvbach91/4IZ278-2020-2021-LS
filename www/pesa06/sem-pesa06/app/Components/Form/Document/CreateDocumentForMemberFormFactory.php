<?php
declare(strict_types=1);

namespace App\Components\Form\Document;


use App\Domain\Enum\DocumentTypeEnum;
use Nette\Application\UI\Form;

class CreateDocumentForMemberFormFactory
{
    public const AMOUNT = 'amount';
    public const DOCUMENT_TYPE = 'document_type';
    public const MEMBER = 'member';
    public const SEND_TO_MAIL = 'send_to_mail';
    public const FIRST_NAME = 'first_name';
    public const LAST_NAME = 'last_name';


    private CreateDocumentForMemberFormProcessor $processor;

    public function __construct(
        CreateDocumentForMemberFormProcessor $processor
    ) {
        $this->processor = $processor;
    }

    public function create(): Form
    {
        $form = new Form();
        $form->addSelect(self::DOCUMENT_TYPE, 'Typ dokumentu', DocumentTypeEnum::getValues());
        $form->addHidden(self::MEMBER, );
        $form->addText(self::FIRST_NAME, 'Jméno');
        $form->addText(self::LAST_NAME, 'Příjmení');
        $form->addText(self::AMOUNT, 'Částka');
        $form->addCheckbox(self::SEND_TO_MAIL, 'Poslat na mail');
        $form->addSubmit('submit', 'Odeslat');
        $form->onSuccess[] = function (Form $form) {
            $documentId = $this->processor->process($form);
            $form->getPresenter()->redirect('Document:export', ['documentId' => $documentId]);
        };
        return $form;
    }
}