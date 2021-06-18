<?php
declare(strict_types=1);

namespace App\Components\Form\Email;


use Domain\Entity\EmailTemplateEntity;
use Domain\Repository\EmailTemplateRepository;
use Nette\Application\UI\Form;
use Nette\Http\Request;

class EmailTemplateUpsertFormFactory
{
    public const ID = 'id';
    public const TITLE = 'title';
    public const VALUE = 'value';

    private Request $request;
    private EmailTemplateRepository $emailTemplateRepository;
    private EmailTemplateUpsertFormProcessor $processor;

    public function __construct(
        Request $request,
        EmailTemplateRepository $emailTemplateRepository,
        EmailTemplateUpsertFormProcessor $processor
    ) {
        $this->request = $request;
        $this->emailTemplateRepository = $emailTemplateRepository;
        $this->processor = $processor;
    }

    public function create(): Form
    {
        $form = new Form();
        $template = null;
        if (isset($this->request->getQuery()['templateId'])) {
            /** @var EmailTemplateEntity $template */
            $template = $this->emailTemplateRepository->find((int)$this->request->getQuery()['templateId']);
        }
        $form->addHidden(self::ID, $template === null ? null : $template->getId());
        $form->addText(self::TITLE, 'Nadpis')
            ->setRequired()
            ->setDefaultValue($template === null ? null : $template->getTitle());
        $form->addTextArea(self::VALUE, 'Text')
            ->setDefaultValue($template === null ? null : $template->getValue());
        $form->addSubmit('submit', 'Uložit');
        $form->onSuccess[] = function (Form $form) {
            $this->processor->process($form);
            $form->getPresenter()->redirect('EmailTemplate:default');
        };
        return $form;
    }

}