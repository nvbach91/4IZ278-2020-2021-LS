<?php
declare(strict_types=1);

namespace App\Presenters;

class AccountPresenter extends LayoutPresenter
{
    public function actionLogout(): void
    {
        $this->getUser()->logout(true);
        $this->redirect(':Front:Article:default');
    }
}