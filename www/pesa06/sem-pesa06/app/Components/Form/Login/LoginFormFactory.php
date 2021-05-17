<?php
declare(strict_types=1);

namespace App\Components\Form\Login;


use Nette\Application\UI\Form;
use Nette\Forms\FormFactory;
use Nette\Security\AuthenticationException;

class LoginFormFactory
{
    public const USERNAME = 'username';
    public const PASSWORD = 'password';

    private LoginFormProcessor $processor;

    public function __construct(
        LoginFormProcessor $processor
    ) {
        $this->processor = $processor;
    }

    public function create(): Form
    {
        $form = new Form();
        $form->addText(self::USERNAME, 'Email')
            ->setRequired(true);
        $form->addText(self::PASSWORD, 'Heslo')
            ->setHtmlType('password')
            ->setRequired(true);
        $form->addSubmit('submit', 'Odeslat');
        $form->onSuccess[] = function (Form $form) {
            try {
                $this->processor->process($form);
                $form->getPresenter()->redirect(':Backoffice:Member:default');
            } catch (AuthenticationException $exception) {
                $form->getPresenter()->flashMessage($exception->getMessage(), 'alert alert-danger');
                $form->getPresenter()->redirect('this');
            }
        };
        return $form;
    }

}