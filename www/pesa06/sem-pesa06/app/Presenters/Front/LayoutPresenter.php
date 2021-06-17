<?php
declare(strict_types=1);

namespace App\Presenters\Front;


use Domain\Repository\TeamRepository;
use Nette\Application\Helpers;
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
        $this->setLayout(__DIR__ . '/../templates/Front/@layout.latte');
        $this->template->presenter = $this->getPresenter()->getName();
        $this->template->action = $this->getAction();
        $this->template->parameters = $this->getParameters();
        $this->template->menu = $this->teamRepository->prepareMenu();
        $this->template->logoPath = __DIR__ . '../../files/cechie_dubec_logo.jpeg';
    }

    public function formatTemplateFiles(): array
    {
        list($module, $presenter) = Helpers::splitName($this->getName());
        $dir = dirname($this->getReflection()->getFileName());
        $dir = is_dir("$dir/$presenter") ? $dir : dirname($dir);
        return [
            "$dir/templates/Front/$presenter/$this->view.latte",
        ];
    }

}