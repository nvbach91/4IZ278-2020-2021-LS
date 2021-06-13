<?php
declare(strict_types=1);

namespace App\Components\Form\Account;


use App\Components\Form\Account\Exception\AccountFormException;
use App\Service\Email\EmailService;
use Domain\Entity\AccountEntity;
use Domain\Repository\AccountRepository;
use Nette\Application\UI\Form;
use Nette\Security\User;

class AccountFormProcessor
{
    private AccountRepository $accountRepository;
    private EmailService $emailService;
    private User $user;

    public function __construct(
        AccountRepository $accountRepository,
        EmailService $emailService,
        User $user
    ) {
        $this->accountRepository = $accountRepository;
        $this->emailService = $emailService;
        $this->user = $user;
    }

    public function process(Form $form): void
    {
        $values = $form->getValues();
        $account = null;
        if ($values[AccountFormFactory::ID] !== '') {
            $account = $this->accountRepository->find((int)$values[AccountFormFactory::ID]);
        }
        if ($account === null) {
            if ($this->accountRepository->findByUsername($values[AccountFormFactory::EMAIL]) !== null) {
                throw new AccountFormException('Account with this email already exists!');
            }
            $account = new AccountEntity();
        }
        $account->setEmail($values[AccountFormFactory::EMAIL]);
        $account->setStaffId($values[AccountFormFactory::STAFF]);
        $account->setRole($values[AccountFormFactory::ROLE]);
        $account->setIsActive($values[AccountFormFactory::IS_ACTIVE] === 'bool_1');
        if ($values[AccountFormFactory::ID] === '') {
            $password = $this->generateRandomPassword();
            $account->setPassword(password_hash($password, PASSWORD_DEFAULT));
            $account->setCreatedBy($this->user->getIdentity()->getData()['username']);
            $this->accountRepository->persist($account);
            $this->emailService->sendFromTemplate('Nové heslo do administrace', 'password.latte', $account->getEmail(), ['password' => $password]);
            return;
        }
        $account->setModifiedBy($this->user->getIdentity()->getData()['username']);
        $account->setModified(new \DateTime());
        $this->accountRepository->persist($account);
    }

    private function generateRandomPassword(): string
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }
}