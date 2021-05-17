<?php
declare(strict_types=1);

namespace App\Components\Grid;


use App\Domain\Repository\EmailTemplateRepository;
use Dibi\Row;
use Grido\Components\Filters\Filter;
use Grido\Customization;
use Grido\Grid;
use Nette\Application\LinkGenerator;
use Nette\ComponentModel\IComponent;
use Nette\Utils\Html;

class EmailTemplateGridBuilder
{
    private const TITLE = 'title';
    private const ACTIONS = 'actions';

    private EmailTemplateRepository $emailTemplateRepository;
    private LinkGenerator $linkGenerator;

    public function __construct(
        EmailTemplateRepository $emailTemplateRepository,
        LinkGenerator $linkGenerator
    ) {
        $this->emailTemplateRepository = $emailTemplateRepository;
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
        $grid->setModel($this->emailTemplateRepository->collection());
        $grid->setDefaultPerPage(30);
        $grid->setFilterRenderType(Filter::RENDER_INNER);
        $customization = new Customization($grid);
        $customization->setButtonClass('btn-outline-primary');
        $customization->useTemplateBootstrap();
        $grid->setCustomization($customization);
    }

    public function buildColumns(Grid $grid): void
    {
        $grid->addColumnText(self::TITLE, 'Nadpis')
            ->setSortable()
            ->setCustomRender(function (Row $row) {
                return Html::el('p')
                    ->setAttribute('style', 'width: 600px')
                    ->setText($row['title']);
            });
        $grid->addColumnText(self::ACTIONS, '')
        ->setCustomRender(function (Row $row) {
            return Html::el('div')
                ->setAttribute('style', 'display: flex; justify-content: space-between; max-width: 260px')
                ->addHtml(Html::el('a')
                    ->setAttribute('class', 'btn btn-outline-primary')
                    ->setText('Upravit šablonu')
                    ->href($this->linkGenerator->link('EmailTemplate:upsert', ['templateId' => $row['id']])))
                ->addHtml(Html::el('a')
                    ->setAttribute('class', 'btn btn-outline-success')
                    ->setText('Poslat email')
                    ->href($this->linkGenerator->link('EmailTemplate:send', ['templateId' => $row['id']])));
        });
    }

    public function buildFilters(Grid $grid): void
    {
        $grid->addFilterText(self::TITLE, '');
    }

}