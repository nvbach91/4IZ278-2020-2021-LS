<?php
declare(strict_types=1);

namespace App\Components\Form\Email;


use App\Domain\Entity\EmailTemplateEntity;
use App\Domain\Enum\EmailRecipientEnum;
use App\Domain\Repository\EmailTemplateRepository;
use App\Domain\Repository\TeamRepository;
use App\Service\Email\Exception\EmailServiceException;
use Nette\Application\UI\Form;
use Nette\Http\Request;

class SendEmailFormFactory
{
    public const TEXT = 'text';
    public const TITLE = 'title';
    public const RECIPIENT = 'recipient';
    public const TEAM = 'team';

    private Request $request;
    private SendEmailFormProcessor $processor;
    private EmailTemplateRepository $emailTemplateRepository;
    private TeamRepository $teamRepository;

    public function __construct(
        Request $request,
        SendEmailFormProcessor $processor,
        EmailTemplateRepository $emailTemplateRepository,
        TeamRepository $teamRepository
    ) {
        $this->request = $request;
        $this->processor = $processor;
        $this->emailTemplateRepository = $emailTemplateRepository;
        $this->teamRepository = $teamRepository;
    }

    public function create(): Form
    {
        $form = new Form();
        $template = null;
        if (isset($this->request->getQuery()['templateId'])) {
            /** @var EmailTemplateEntity $template */
            $template = $this->emailTemplateRepository->find((int)$this->request->getQuery()['templateId']);
        }
        $form->addText(self::TITLE, 'Nadpis')
            ->setDefaultValue($template === null ? null : $template->getTitle());
        $form->addTextArea(self::TEXT, 'Text')
            ->setDefaultValue($template === null ? null : $template->getValue());
        $form->addSelect(self::RECIPIENT, 'Příjemce')
            ->setItems(['' => '---'] + EmailRecipientEnum::getValues(), false)
            ->setHtmlId('recipientSelect');
        $form->addSelect(self::TEAM, 'Team')
            ->setItems(['' => '---'] + $this->teamRepository->fetchPairs('id', 'name'))
            ->setHtmlAttribute('disabled')
            ->setHtmlId('teamSelect');
        $form->addSubmit('submit', 'Odeslat');
        $form->onSuccess[] = function (Form $form) {
            try {
                $this->processor->process($form);
                $form->getPresenter()->flashMessage('Email sent.', 'alert alert-success');
            } catch (EmailServiceException $exception){
                $form->getPresenter()->flashMessage($exception->getMessage(), 'alert alert-danger');
            }
            $form->getPresenter()->redirect('EmailTemplate:default');
        };
        return $form;
    }

}