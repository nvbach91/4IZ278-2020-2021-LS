<?php
declare(strict_types=1);

namespace App\Presenters;

use App\Components\Form\Account\AccountFormFactory;
use App\Components\Grid\AccountGridBuilder;
use App\Domain\Enum\RoleEnum;
use Nette\Application\UI\Form;
use Nette\ComponentModel\IComponent;

class AccountPresenter extends LayoutPresenter
{
    private AccountGridBuilder $accountGridBuilder;
    private AccountFormFactory $accountFormFactory;

    public function __construct(
        AccountGridBuilder $accountGridBuilder,
        AccountFormFactory $accountFormFactory
    )
    {
        parent::__construct();
        $this->accountGridBuilder = $accountGridBuilder;
        $this->accountFormFactory = $accountFormFactory;
    }

    public function beforeRender(): void
    {
        parent::beforeRender();
        $isAdmin = false;
        foreach ($this->user->getRoles() as $role) {
            if ($role === RoleEnum::ROLE_ADMIN) {
                $isAdmin = true;
            }
        }
        if ($isAdmin === false) {
            $this->flashMessage('Na tuto akci nemáš oprávnění!', 'alert alert-danger');
            $this->redirect('Article:default');
        }
    }

    public function actionLogout(): void
    {
        $this->getUser()->logout(true);
        $this->redirect(':Front:Article:default');
    }

    public function createComponentAccountGrid(): IComponent
    {
        return $this->accountGridBuilder->build();
    }

    public function createComponentAccountForm(): Form
    {
        return $this->accountFormFactory->create();
    }
}