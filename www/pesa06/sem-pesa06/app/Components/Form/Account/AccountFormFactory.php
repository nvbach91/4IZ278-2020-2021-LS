<?php
declare(strict_types=1);

namespace App\Components\Form\Account;


use App\Components\Form\Account\Exception\AccountFormException;
use App\Domain\Enum\RoleEnum;
use Domain\Entity\AccountEntity;
use Domain\Repository\AccountRepository;
use Domain\Repository\StaffRepository;
use Nette\Application\UI\Form;
use Nette\Http\Request;

class AccountFormFactory
{
    public const ID = 'id';
    public const EMAIL = 'email';
    public const IS_ACTIVE = 'is_active';
    public const STAFF = 'staff';
    public const ROLE = 'role';

    private AccountRepository $accountRepository;
    private StaffRepository $staffRepository;
    private AccountFormProcessor $processor;
    private Request $request;

    public function __construct(
        AccountRepository $accountRepository,
        StaffRepository $staffRepository,
        AccountFormProcessor $processor,
        Request $request
    ) {
        $this->accountRepository = $accountRepository;
        $this->staffRepository = $staffRepository;
        $this->processor = $processor;
        $this->request = $request;
    }

    public function create(): Form
    {
        $id = $this->request->getQuery('accountId');
        $account = null;
        if ($id !== null && $id !== '') {
            /** @var AccountEntity $account */
            $account = $this->accountRepository->find((int)$id);
        }
        $form = new Form();
        $form->addHidden(self::ID, $id);
        $form->addText(self::EMAIL, 'Email')
            ->setDefaultValue($account === null ? null : $account->getEmail());
        $form->addSelect(self::IS_ACTIVE, 'Aktivní', ['bool_0' => 'NE', 'bool_1' => 'bool_1'])
            ->setDefaultValue($account === null ? 'bool_1' : ($account->isActive() ? 'bool_1' : 'bool_0'));
        $form->addSelect(self::ROLE, 'Role', [RoleEnum::ROLE_ADMIN => RoleEnum::ROLE_ADMIN, RoleEnum::ROLE_TEAM_MAINTAINER => RoleEnum::ROLE_TEAM_MAINTAINER])
            ->setDefaultValue($account === null ? RoleEnum::ROLE_TEAM_MAINTAINER : $account->getRole());
        $form->addSelect(self::STAFF, 'Zaměstnanec', $this->staffRepository->prepareSelect())
            ->setDefaultValue($account === null ? null : $account->getStaffId());
        $form->addSubmit('submit', 'Odeslat');
        $form->onSuccess[] = function (Form $form) {
            try {
                $this->processor->process($form);
            } catch (AccountFormException $exception) {
                $form->getPresenter()->flashMessage($exception->getMessage(), 'alert alert-danger');
            }
            $form->getPresenter()->redirect('Account:default');
        };
        return $form;
    }
}