<?php
declare(strict_types=1);

namespace App\Service\Email;


use App\Domain\Enum\EmailRecipientEnum;
use Domain\Repository\MemberRepository;
use App\Service\Email\Exception\EmailServiceException;
use Nette\Mail\Message;
use Nette\Mail\SmtpMailer;

class EmailService
{
    private SmtpMailer $mailer;
    private MemberRepository $memberRepository;

    public function __construct(
        array $mailerData,
        MemberRepository $memberRepository
    ) {
        $this->mailer = new SmtpMailer($mailerData);
        $this->memberRepository = $memberRepository;
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
            case EmailRecipientEnum::EXECUTIVES:
                return $this->memberRepository->getExecutivesMails();
            case EmailRecipientEnum::COACHES:
                return $this->memberRepository->getCoachesMails();
            default:
                throw new EmailServiceException('Not implemented yet');
        }

    }
}