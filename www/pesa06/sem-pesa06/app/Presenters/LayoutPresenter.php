<?php
declare(strict_types=1);

namespace App\Presenters;


use App\Domain\Repository\TeamRepository;
use Nette\Application\UI\Presenter;

class LayoutPresenter extends Presenter
{
    private TeamRepository $teamRepository;

    public function __construct(
        TeamRepository $teamRepository
    )
    {
        parent::__construct();
        $this->teamRepository = $teamRepository;
    }

    public function beforeRender()
    {
        parent::beforeRender();
        $this->template->menu = $this->teamRepository->prepareMenu();
        $this->template->logoPath = __DIR__ . '../../files/cechie_dubec_logo.jpeg';
    }


}