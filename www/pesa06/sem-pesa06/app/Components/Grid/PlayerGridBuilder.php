<?php
declare(strict_types=1);

namespace App\Components\Grid;


use Domain\Repository\PlayerRepository;
use Domain\Repository\TeamRepository;
use App\Handler\PlayerIsActiveToggleHandler;
use Dibi\Fluent;
use Dibi\Row;
use Grido\Components\Filters\Filter;
use Grido\Customization;
use Grido\Grid;
use Nette\Application\LinkGenerator;
use Nette\ComponentModel\IComponent;
use Nette\Utils\Html;

class PlayerGridBuilder
{
    private const FIRST_NAME = 'first_name';
    private const LAST_NAME = 'last_name';
    private const TEAM_NAME = 'team_name';
    private const IS_ACTIVE = 'is_active';
    private const YEAR_OF_BIRTH = 'year_of_birth';
    private const FACR_ID = 'facr_id';
    private const ACTIONS = 'actions';


    private PlayerRepository $playerRepository;
    private LinkGenerator $linkGenerator;
    private TeamRepository $teamRepository;

    public function __construct(
        PlayerRepository $playerRepository,
        LinkGenerator $linkGenerator,
        TeamRepository $teamRepository
    ) {
        $this->playerRepository = $playerRepository;
        $this->linkGenerator = $linkGenerator;
        $this->teamRepository = $teamRepository;
    }

    public function create(): IComponent
    {
        $grid = new Grid();

        $this->setModel($grid);
        $this->buildColumns($grid);
        $this->buildFilters($grid);

        return $grid;
    }

    private function setModel(Grid $grid): void
    {
        $grid->setModel($this->playerRepository->prepareCollection());
        $grid->setDefaultPerPage(30);
        $grid->setFilterRenderType(Filter::RENDER_INNER);
        $customization = new Customization($grid);
        $customization->setButtonClass('btn-outline-primary');
        $customization->useTemplateBootstrap();
        $grid->setCustomization($customization);
    }

    private function buildColumns(Grid $grid): void
    {
        $grid->addColumnText(self::FIRST_NAME, 'Jméno')
            ->setSortable();
        $grid->addColumnText(self::LAST_NAME, 'Příjmení')
            ->setSortable();
        $grid->addColumnText(self::IS_ACTIVE, 'Aktivní')
            ->setSortable()
            ->setCustomRender(function (Row $row){
                if ($row['is_active']){
                    return Html::el('span')
                        ->setAttribute('class', 'badge badge-success')
                        ->setText('ANO');
                }
                return Html::el('span')
                    ->setAttribute('class', 'badge badge-danger')
                    ->setText('NE');
            });
        $grid->addColumnText(self::TEAM_NAME, 'Název týmu')
            ->setSortable()
            ->setCustomRender(function (Row $row) {
                if (empty($row['team_id'])) {
                    return Html::el('p');
                }
                return Html::el('a')
                    ->setText($row['team_name'])
                    ->href($this->linkGenerator->link('Backoffice:Team:detail', ['teamId' => $row['team_id']]));
            });
        $grid->addColumnText(self::YEAR_OF_BIRTH, 'Rok narození')
            ->setSortable();
        $grid->addColumnText(self::FACR_ID, 'FAČR ID')
            ->setSortable()
            ->setCustomRender(function (Row $row) {
                if ((bool)$row['is_active'] === false) {
                    return;
                }
                return Html::el('p')
                    ->setText($row['facr_id']);
            });
        $grid->addColumnText(self::ACTIONS, '')
            ->setCustomRender(function (Row $row) {
                return Html::el('div')
                    ->setAttribute('style', 'display: flex; justify-content: space-between; max-width: 235px;')
                    ->addHtml(Html::el('a')
                        ->setAttribute('class', $row['is_active'] ? 'btn btn-outline-danger' : 'btn btn-outline-success')
                        ->setText($row['is_active'] ? 'Deaktivovat' : 'Aktivovat')
                        ->href($this->linkGenerator->link('Backoffice:Player:togglePlayerIsActive', ['playerId' => $row['id']])))
                    ->addHtml(Html::el('a')
                        ->setAttribute('class', 'btn btn-outline-primary')
                        ->setText('Upravit clena')
                        ->href($this->linkGenerator->link('Backoffice:Member:upsert', ['memberId' => $row['member_id']])));
            });
    }

    private function buildFilters(Grid $grid): void
    {
        $grid->addFilterText(self::FIRST_NAME, 'Jméno');
        $grid->addFilterText(self::LAST_NAME, 'Příjmení');
        $grid->addFilterSelect(self::IS_ACTIVE, 'Aktivní', ['' => '---', true => 'ANO', false => 'NE'])
            ->setWhere(function (bool $value, Fluent $fluent) {
                $fluent->where('p.is_active = %s', $value);
            });
        $grid->addFilterSelect(self::TEAM_NAME, 'Název týmu', ['' => '---'] + $this->teamRepository->fetchPairs('id', 'name'))
            ->setWhere(function (int $teamId, Fluent $fluent) {
                $fluent->where('t.id = %i', $teamId);
            });
        $grid->addFilterText(self::YEAR_OF_BIRTH, 'Rok narození');
        $grid->addFilterText(self::FACR_ID, 'FAČR ID');
    }

}