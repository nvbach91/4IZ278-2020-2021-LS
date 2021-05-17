<?php
declare(strict_types=1);

namespace App\Components\Form\Email;


use App\Domain\Enum\EmailRecipientEnum;
use App\Service\Email\Exception\EmailServiceException;
use Nette\Application\UI\Form;
use App\Service\Email\EmailService;

class SendEmailFormProcessor
{
    private EmailService $emailService;

    public function __construct(
        EmailService $emailService
    ) {
        $this->emailService = $emailService;
    }
    public function process(Form $form): void
    {
        $values = $form->getValues();
        try {
            $this->emailService->sendMail($values[SendEmailFormFactory::TITLE], $values[SendEmailFormFactory::TEXT],
                $values[SendEmailFormFactory::RECIPIENT], $values[SendEmailFormFactory::RECIPIENT] === EmailRecipientEnum::TEAM ?
                    $values[SendEmailFormFactory::TEAM] : null);
        } catch (EmailServiceException $exception) {
            throw new EmailServiceException($exception->getMessage());
        }
    }

}