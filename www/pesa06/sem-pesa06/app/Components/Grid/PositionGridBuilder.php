<?php
declare(strict_types=1);

namespace App\Components\Grid;

use Domain\Entity\PositionEntity;
use Dibi\Row;
use Domain\Repository\PositionRepository;
use Grido\Components\Filters\Filter;
use Grido\Customization;
use Grido\Grid;
use Nette\Application\LinkGenerator;
use Nette\ComponentModel\IComponent;
use Nette\Utils\Html;

class PositionGridBuilder
{
    private const NAME = 'name';
    private const CREATED_BY = 'created_by';
    private const ACTIONS = 'actions';

    private PositionRepository $positionRepository;
    private LinkGenerator $linkGenerator;

    public function __construct(
        PositionRepository $positionRepository,
        LinkGenerator $linkGenerator
    ) {
        $this->positionRepository = $positionRepository;
        $this->linkGenerator = $linkGenerator;
    }

    public function build(): IComponent
    {
        $grid = new Grid();

        $this->setModel($grid);
        $this->buildColumnst($grid);
        $this->buildFilters($grid);

        return $grid;
    }

    private function setModel(Grid $grid): void
    {
        $grid->setModel($this->positionRepository->collection());
        $grid->setDefaultPerPage(30);
        $grid->setFilterRenderType(Filter::RENDER_INNER);
        $customization = new Customization($grid);
        $customization->setButtonClass('btn-outline-primary');
        $grid->setTemplateFile(__DIR__ . '/templates/default.latte');
        $grid->setCustomization($customization);
    }

    private function buildColumnst(Grid $grid): void
    {
        $grid->addColumnText(self::NAME, 'Název pozice');
        $grid->addColumnText(self::CREATED_BY, 'Vytvořil');
        $grid->addColumnText(self::ACTIONS, 'Akce')
            ->setCustomRender(function (Row $row) {
                return Html::el('a')
                    ->href($this->linkGenerator->link('Backoffice:Position:edit', ['positionId' => $row['id']]))
                    ->setText('Upravit');
            });
    }

    private function buildFilters(Grid $grid): void
    {
        $grid->addFilterText(self::NAME, 'Název pozice');
    }
}