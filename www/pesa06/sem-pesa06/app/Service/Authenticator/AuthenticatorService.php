<?php
declare(strict_types=1);

namespace App\Service\Authenticator;

use App\Domain\Enum\RoleEnum;
use Domain\Repository\AccountRepository;
use Nette\Security\AuthenticationException;
use Nette\Security\Authenticator;
use Nette\Security\IIdentity;
use Nette\Security\SimpleIdentity;

class AuthenticatorService implements Authenticator
{
    private AccountRepository $accountRepository;
    private array $backupAccountData;

    public function __construct(
        array $backupAccountData,
        AccountRepository $accountRepository
    ) {
        $this->accountRepository = $accountRepository;
        $this->backupAccountData = $backupAccountData;
    }

    function authenticate(string $user, string $password): IIdentity
    {
        if (count($this->accountRepository->getAll()) === 0) {
            if ($user === $this->backupAccountData[0] && $password === $this->backupAccountData[1]) {
                return new SimpleIdentity(0,
                    [RoleEnum::ROLE_ADMIN],
                    ['username' => $this->backupAccountData[0]]
                );
            } else {
                throw new AuthenticationException('Data does not match!');
            }
        } else {
            $account = $this->accountRepository->findByUsername($user);
            if ($account === null) {
                throw new AuthenticationException('No account found for this username!');
            } else {
                if (password_verify($password, $account->getPassword()) === true) {
                    return new SimpleIdentity($account->getId(),
                        [$account->getRole()],
                        ['username' => $account->getEmail()],
                    );
                } else {
                    throw new AuthenticationException('Password is not correct!');
                }
            }
        }
    }
}