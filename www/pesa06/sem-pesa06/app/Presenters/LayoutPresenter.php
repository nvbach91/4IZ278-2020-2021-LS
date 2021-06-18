<?php
declare(strict_types=1);

namespace App\Presenters;


use Domain\Repository\TeamRepository;
use Nette\Application\UI\Presenter;

class LayoutPresenter extends Presenter
{
    private TeamRepository $teamRepository;

    public function injectBase(
        TeamRepository $teamRepository
    )
    {
        parent::__construct();
        $this->teamRepository = $teamRepository;
    }

    public function beforeRender()
    {
        parent::beforeRender();
        if ($this->getUser()->isLoggedIn() === false) {
            $this->flashMessage('Please login first!', 'alert alert-danger');
            $this->redirect(':Front:Article:default');
        }
        $this->template->presenter = $this->getPresenter()->getName();
        $this->template->action = $this->getAction();
        $this->template->parameters = $this->getParameters();
        $this->template->menu = $this->teamRepository->prepareMenu();
        $this->template->logoPath = __DIR__ . '../../files/cechie_dubec_logo.jpeg';
    }


}