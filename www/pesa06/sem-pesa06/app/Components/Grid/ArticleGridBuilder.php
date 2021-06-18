<?php
declare(strict_types=1);

namespace App\Components\Grid;


use Domain\Repository\ArticleRepository;
use Domain\Repository\TeamRepository;
use Dibi\Row;
use Grido\Components\Filters\Filter;
use Grido\Customization;
use Grido\Grid;
use Nette\Application\LinkGenerator;
use Nette\ComponentModel\IComponent;
use Nette\Utils\Html;

class ArticleGridBuilder
{
    private const TITLE = 'title';
    private const TEAM_ID = 'team_id';
    private const CREATED_AT = 'created_at';
    private const ACTION_UPSERT = 'action_upsert';

    private ArticleRepository $articleRepository;
    private LinkGenerator $linkGenerator;
    private TeamRepository $teamRepository;

    public function __construct(
        ArticleRepository $articleRepository,
        LinkGenerator $linkGenerator,
        TeamRepository $teamRepository
    ) {
        $this->articleRepository = $articleRepository;
        $this->linkGenerator = $linkGenerator;
        $this->teamRepository = $teamRepository;
    }

    public function build(): IComponent
    {
        $grid = new Grid();

        $this->setModel($grid);
        $this->buildColumns($grid);
        $this->buildFilters($grid);

        return $grid;
    }

    private function setModel(Grid $grid): void
    {
        $grid->setModel($this->articleRepository->collection());
        $grid->setDefaultPerPage(30);
        $grid->setFilterRenderType(Filter::RENDER_INNER);
        $customization = new Customization($grid);
        $grid->setTemplateFile(__DIR__ . '/templates/default.latte');
        $grid->setCustomization($customization);
    }

    private function buildColumns(Grid $grid): void
    {
        $grid->addColumnText(self::TITLE, 'Nadpis')
            ->setSortable()
            ->setCustomRender(function (Row $row) {
                return Html::el('a')
                    ->setText($row['title'])
                    ->href($this->linkGenerator->link('Backoffice:Article:upsert', ['articleId' => $row['id']]));
            });
        $grid->addColumnText(self::TEAM_ID, 'Tým')
            ->setSortable()
            ->setCustomRender(function (Row $row) {
                if ($row['team_id'] === null) {
                    return Html::el('p')
                        ->setText('Všeobecný článek');
                }
            return Html::el('a')
                ->setText($this->teamRepository->findById($row['team_id'])->getName())
                ->href($this->linkGenerator->link('Backoffice:Team:upsert', ['teamId' => $row['team_id']]));
            });
        $grid->addColumnText(self::CREATED_AT, 'Datum vytvoření')
            ->setSortable()
            ->setCustomRender(function (Row $row){
                return Html::el('p')
                    ->setText($row['created_at']->format('d.m.Y'));
            });
        $grid->addColumnText(self::ACTION_UPSERT, 'Upravit článek')
            ->setCustomRender(function (Row $row){
                return Html::el('a')
                    ->setAttribute('class', 'btn btn-outline-primary')
                    ->setText('Upravit článek')
                    ->href($this->linkGenerator->link('Backoffice:Article:upsert', ['articleId' => $row['id']]));
            });
    }

    private function buildFilters(Grid $grid): void
    {
        $grid->addFilterText(self::TITLE, 'Nadpis');
        $grid->addFilterSelect(self::TEAM_ID, 'Tym', [null => '---'] + $this->teamRepository->fetchPairs('id', 'name'));
        $grid->addFilterDate(self::CREATED_AT, 'Datum');
    }



}