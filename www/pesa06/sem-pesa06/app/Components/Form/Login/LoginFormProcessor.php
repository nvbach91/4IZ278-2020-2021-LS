<?php
declare(strict_types=1);

namespace App\Components\Form\Login;


use Nette\Application\UI\Form;
use Nette\Security\User;

class LoginFormProcessor
{
    private User $user;

    public function __construct(
        User $user
    ) {
        $this->user = $user;
    }

    public function process(Form  $form): void
    {
        $values = $form->getValues(true);
        $this->user->login($values[LoginFormFactory::USERNAME], $values[LoginFormFactory::PASSWORD]);
    }
}