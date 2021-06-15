<?php
declare(strict_types=1);

namespace App\Components\Grid;


use App\Domain\Enum\StaffTypeEnum;
use Domain\Repository\StaffRepository;
use Dibi\Fluent;
use Dibi\Row;
use Grido\Components\Filters\Filter;
use Grido\Customization;
use Grido\Grid;
use Nette\Application\LinkGenerator;
use Nette\ComponentModel\IComponent;
use Nette\Utils\Html;

class StaffGridBuilder
{
    private const FIRST_NAME = 'first_name';
    private const LAST_NAME = 'last_name';
    private const IS_MEMBER = 'is_member';
    private const ACTION = 'action';

    private LinkGenerator $linkGenerator;
    private StaffRepository $staffRepository;

    public function __construct(
        LinkGenerator $linkGenerator,
        StaffRepository $staffRepository
    ) {
        $this->linkGenerator = $linkGenerator;
        $this->staffRepository = $staffRepository;
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
        $grid->setModel($this->staffRepository->prepareStaffGridCollection());
        $grid->setDefaultPerPage(30);
        $grid->setFilterRenderType(Filter::RENDER_INNER);
        $customization = new Customization($grid);
        $customization->setButtonClass('btn-outline-primary');
        $grid->setTemplateFile(__DIR__ . '/templates/default.latte');
        $grid->setCustomization($customization);
    }

    private function buildColumns(Grid $grid): void
    {
        $grid->addColumnText(self::FIRST_NAME, 'Jméno')
            ->setSortable();
        $grid->addColumnText(self::LAST_NAME, 'Příjmení')
            ->setSortable();
        $grid->addColumnText(self::IS_MEMBER, 'Členem')
            ->setSortable()
            ->setCustomRender(function (Row $row) {
                if ($row['member_id'] !== null){
                    return Html::el('span')
                        ->setAttribute('class', 'badge badge-success')
                        ->setText('ANO');
                }
                return Html::el('span')
                    ->setAttribute('class', 'badge badge-danger')
                    ->setText('NE');
            });
        $grid->addColumnText(self::ACTION, '')
            ->setCustomRender(function (Row $row) {
                $div = Html::el('div')
                    ->setAttribute('style', 'display: flex; justify-content: space-between; max-width: 305px;')
                    ->addHtml(Html::el('a')
                        ->setAttribute('class', 'btn btn-outline-primary')
                        ->setText('Upravit zaměstnance')
                        ->href($this->linkGenerator->link('Backoffice:Staff:upsert', ['staffId' => $row['id']])));
                if ($row['member_id'] !== null) {
                    $div->addHtml(Html::el('a')
                        ->setAttribute('class', 'btn btn-outline-secondary')
                        ->setText('Upravit clena')
                        ->href($this->linkGenerator->link('Backoffice:Member:upsert', ['memberId' => $row['member_id']])));
                }
                return $div;
            });
    }

    private function buildFilters(Grid $grid): void
    {
        $grid->addFilterText(self::FIRST_NAME, '');
        $grid->addFilterText(self::LAST_NAME, '');
        $grid->addFilterSelect(self::IS_MEMBER, '', ['' => '---', true => 'ANO', false => 'NE'])
            ->setWhere(function ($value, Fluent $fluent) {
                if ($value === true) {
                    return $fluent->where('s.member_id IS NOT NULL');
                    } else {
                    return $fluent->where('s.member_id IS NULL');
                }
            });
    }

}