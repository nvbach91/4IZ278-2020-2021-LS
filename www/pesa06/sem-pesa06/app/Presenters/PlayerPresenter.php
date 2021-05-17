<?php
declare(strict_types=1);

namespace App\Presenters;


use App\Components\Grid\PlayerGridBuilder;
use App\Domain\Repository\TeamRepository;
use App\Handler\AssignPlayersToTeamsHandler;
use App\Handler\Exception\PlayerIsActiveToggleHandlerException;
use App\Handler\PlayerIsActiveToggleHandler;
use App\Service\Import\PlayerXlsImportService;
use Nette\ComponentModel\IComponent;

class PlayerPresenter extends LayoutPresenter
{
    private PlayerGridBuilder $playerGridBuilder;
    private PlayerXlsImportService $playerXlsImportService;
    private PlayerIsActiveToggleHandler $activeToggleHandler;
    private AssignPlayersToTeamsHandler $assignPlayersHandler;

    public function __construct(
        PlayerGridBuilder $playerGridBuilder,
        PlayerXlsImportService $playerXlsImportService,
        PlayerIsActiveToggleHandler $activeToggleHandler,
        AssignPlayersToTeamsHandler $assignPlayersHandler,
        TeamRepository $teamRepository
    ) {
        parent::__construct($teamRepository);
        $this->playerGridBuilder = $playerGridBuilder;
        $this->playerXlsImportService = $playerXlsImportService;
        $this->activeToggleHandler = $activeToggleHandler;
        $this->assignPlayersHandler = $assignPlayersHandler;
    }

    public function createComponentPlayerGrid(): IComponent
    {
        return $this->playerGridBuilder->create();
    }

    public function actionImport(): void
    {
        $this->playerXlsImportService->import();
        $this->redirect('Player:default');
    }

    public function actionTogglePlayerIsActive(int $playerId): void
    {
        try {
            $this->activeToggleHandler->handle($playerId);
        } catch (PlayerIsActiveToggleHandlerException $exception) {
            $this->flashMessage($exception->getMessage());
        }
        $this->redirect('default');
    }

    public function actionAssignPlayersToTeams(): void
    {
        $this->assignPlayersHandler->handle();
        $this->redirect('default');
    }

}