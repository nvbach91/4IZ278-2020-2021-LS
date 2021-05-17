<?php
declare(strict_types=1);

namespace App\Components\Grid;


use App\Domain\Repository\TeamRepository;
use Grido\Components\Filters\Filter;
use Grido\Customization;
use Grido\Grid;
use Dibi\Row;
use Nette\Application\LinkGenerator;
use Nette\ComponentModel\IComponent;
use Nette\Utils\Html;

class TeamGridBuilder
{
    private const NAME = 'name';
    private const AGE_UNDER = 'age_under';
    private const COMPETITION = 'competition';
    private const IS_YOUTH = 'is_youth';
    private const ACTION_UPSERT = 'action_upsert';


    private TeamRepository $teamRepository;
    private LinkGenerator $linkGenerator;

    public function __construct(
        TeamRepository $teamRepository,
        LinkGenerator $linkGenerator
    ) {
        $this->teamRepository = $teamRepository;
        $this->linkGenerator = $linkGenerator;
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
        $grid->setModel($this->teamRepository->collection());
        $grid->setDefaultPerPage(30);
        $grid->setFilterRenderType(Filter::RENDER_INNER);
        $customization = new Customization($grid);
        $customization->useTemplateBootstrap();
        $grid->setCustomization($customization);
    }

    private function buildColumns(Grid $grid): void
    {
        $grid->addColumnText(self::NAME, 'Jméno')
            ->setSortable()
        ->setCustomRender(function (Row $row) {
            return Html::el('a')
                ->setText($row['name'])
                ->href($this->linkGenerator->link('Team:detail', ['teamId' => $row['id']]));
        });
        $grid->addColumnText(self::COMPETITION, 'Soutěž')
            ->setSortable();
        $grid->addColumnText(self::AGE_UNDER, 'Věk do')
            ->setSortable();
        $grid->addColumnText(self::IS_YOUTH, 'Mládež')
            ->setSortable()
            ->setCustomRender(function (Row $row){
                if ($row['is_youth']){
                    return Html::el('span')
                        ->setAttribute('class', 'badge badge-success')
                        ->setText('ANO');
                }
                return Html::el('span')
                    ->setAttribute('class', 'badge badge-danger')
                    ->setText('NE');
            });
        $grid->addColumnText(self::ACTION_UPSERT, 'Upravit tým')
            ->setCustomRender(function (Row $row){
                return Html::el('a')
                    ->setAttribute('class', 'btn btn-outline-primary')
                    ->setText('Upravit tým')
                    ->href($this->linkGenerator->link('Team:upsert', ['teamId' => $row['id']]));
            });
    }

    private function buildFilters(Grid $grid): void
    {
        $grid->addFilterText(self::NAME, 'Jméno');
        $grid->addFilterText(self::COMPETITION, 'Soutěž');
        $grid->addFilterText(self::AGE_UNDER, 'Věk');
        $grid->addFilterText(self::IS_YOUTH, 'Mládež');
    }


}