<?php
declare(strict_types=1);

namespace App\Components\Form\Email;


use Domain\Entity\EmailTemplateEntity;
use Domain\Repository\EmailTemplateRepository;
use Nette\Application\UI\Form;

class EmailTemplateUpsertFormProcessor
{
    private EmailTemplateRepository $emailTemplateRepository;

    public function __construct(
        EmailTemplateRepository $emailTemplateRepository
    ) {
        $this->emailTemplateRepository = $emailTemplateRepository;
    }

    public function process(Form $form): void
    {
        $values = $form->getValues();
        $oldTemplate = $this->emailTemplateRepository->find((int)$values[EmailTemplateUpsertFormFactory::ID]);
        $template = $oldTemplate === null ? new EmailTemplateEntity() : $oldTemplate;
        $template->setTitle($values[EmailTemplateUpsertFormFactory::TITLE]);
        $template->setValue($values[EmailTemplateUpsertFormFactory::VALUE]);
        if ($oldTemplate === null) {
            $template->setCreatedAt(new \DateTime());
            $template->setCreatedBy('admin');
            $this->emailTemplateRepository->persist($template);
            return;
        }
        $template->setModifiedAt(new \DateTime());
        $template->setModifiedBy('admin');
        $this->emailTemplateRepository->persist($template);
    }

}