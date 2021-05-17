<?php
declare(strict_types=1);

namespace App\Presenters;


use App\Components\Form\Email\EmailTemplateUpsertFormFactory;
use App\Components\Form\Email\SendEmailFormFactory;
use App\Components\Grid\EmailTemplateGridBuilder;
use App\Domain\Repository\TeamRepository;
use Nette\Application\UI\Form;
use Nette\ComponentModel\IComponent;

class EmailTemplatePresenter extends LayoutPresenter
{
    private EmailTemplateGridBuilder $emailTemplateGridBuilder;
    private EmailTemplateUpsertFormFactory $templateUpsertFactory;
    private SendEmailFormFactory $sendEmailFactory;

    public function __construct(
        TeamRepository $teamRepository,
        EmailTemplateGridBuilder $emailTemplateGridBuilder,
        EmailTemplateUpsertFormFactory $templateUpsertFactory,
        SendEmailFormFactory $sendEmailFactory
    ) {
        parent::__construct($teamRepository);
        $this->emailTemplateGridBuilder = $emailTemplateGridBuilder;
        $this->templateUpsertFactory = $templateUpsertFactory;
        $this->sendEmailFactory = $sendEmailFactory;
    }

    public function createComponentEmailTemplateGrid(): IComponent
    {
        return $this->emailTemplateGridBuilder->create();
    }

    public function createComponentEmailTemplateUpsertForm(): Form
    {
        return $this->templateUpsertFactory->create();
    }

    public function createComponentSendEmailForm(): Form
    {
        return $this->sendEmailFactory->create();
    }

}