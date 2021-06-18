<?php
declare(strict_types=1);

namespace App\Components\Grid;


use Dibi\Row;
use Domain\Repository\StaffPositionTeamRepository;
use Grido\Components\Filters\Filter;
use Grido\Customization;
use Grido\Grid;
use Nette\Application\LinkGenerator;
use Nette\ComponentModel\IComponent;
use Nette\Http\Request;
use Nette\Utils\Html;

class StaffPositionGridBuilder
{
    private const POSITION = 'position';
    private const TEAM = 'team';
    private const ACTIONS = 'actions';

    private StaffPositionTeamRepository $staffPositionTeamRepository;
    private LinkGenerator $linkGenerator;
    private Request $request;

    public function __construct(
        StaffPositionTeamRepository $staffPositionTeamRepository,
        LinkGenerator $linkGenerator,
        Request $request
    ) {
        $this->linkGenerator = $linkGenerator;
        $this->staffPositionTeamRepository = $staffPositionTeamRepository;
        $this->request = $request;
    }

    public function build(): IComponent
    {
        $grid = new Grid();

        $this->setModel($grid);
        $this->buildColumns($grid);

        return $grid;
    }

    private function setModel(Grid $grid): void
    {
        $grid->setModel($this->staffPositionTeamRepository->gridCollection($this->request->getQuery('staffId')));
        $grid->setDefaultPerPage(30);
        $grid->setFilterRenderType(Filter::RENDER_INNER);
        $customization = new Customization($grid);
        $customization->setButtonClass('btn-outline-primary');
        $grid->setTemplateFile(__DIR__ . '/templates/default.latte');
        $grid->setCustomization($customization);
    }

    private function buildColumns(Grid $grid): void
    {
        $grid->addColumnText(self::POSITION, 'Pozice')
            ->setCustomRender(function (Row $row) {
                return Html::el('a')
                    ->href($this->linkGenerator->link('Backoffice:Position:edit', ['positionId' => $row['positionId']]))
                    ->setText($row['position']);
            });
        $grid->addColumnText(self::TEAM, 'Tým')
            ->setCustomRender(function (Row $row) {
                if ($row['teamId'] === null) {
                    return Html::el('p')
                        ->setText('Bez týmu');
                }
                return Html::el('a')
                    ->href($this->linkGenerator->link('Backoffice:Team:detail', ['teamId' => $row['teamId']]))
                    ->setText($row['teamName']);
            });
        $grid->addColumnText(self::ACTIONS, 'Akce')
            ->setCustomRender(function (Row $row) {
                return Html::el('div')
                    ->addHtml(Html::el('a')
                        ->setText('Upravit')
                        ->setAttribute('class', 'btn btn-sm btn-outline-primary')
                        ->href($this->linkGenerator->link('Backoffice:Staff:addPosition', ['staffId' => $this->request->getQuery('staffId'), 'pairingId' => $row['id']])))
                    ->addHtml(Html::el('a')
                        ->setText('Smazat')
                        ->setAttribute('class', 'btn btn-sm btn-outline-danger')
                        ->href($this->linkGenerator->link('Backoffice:Staff:removePosition', ['pairingId' => $row['id'], 'staffId' => (int)$this->request->getQuery('staffId')])));
            });
    }
}