<?php
declare(strict_types=1);

namespace App\Presenters\Front;

use App\Components\Form\Login\LoginFormFactory;
use Nette\Application\UI\Form;

class AccountPresenter extends LayoutPresenter
{
    private LoginFormFactory $loginFormFactory;

    public function __construct(
        LoginFormFactory $loginFormFactory
    )
    {
        parent::__construct();
        $this->loginFormFactory = $loginFormFactory;
    }

    public function createComponentLoginForm(): Form
    {
        return $this->loginFormFactory->create();
    }
}