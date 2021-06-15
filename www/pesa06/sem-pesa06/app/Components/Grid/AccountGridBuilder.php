<?php
declare(strict_types=1);

namespace App\Components\Grid;


use Dibi\Fluent;
use Dibi\Row;
use Domain\Repository\AccountRepository;
use Grido\Components\Filters\Filter;
use Grido\Customization;
use Grido\Grid;
use Nette\Application\LinkGenerator;
use Nette\ComponentModel\IComponent;
use Nette\Utils\Html;

class AccountGridBuilder
{
    private const EMAIL = 'email';
    private const IS_ACTIVE = 'is_active';
    private const ROLE = 'role';
    private const NAME = 'name';
    private const LASTNAME = 'lastname';

    private AccountRepository $accountRepository;
    private LinkGenerator $linkGenerator;

    public function __construct(
        AccountRepository $accountRepository,
        LinkGenerator $linkGenerator
    ) {
        $this->accountRepository = $accountRepository;
        $this->linkGenerator = $linkGenerator;
    }

    public function build(): IComponent
    {
        $grid = new Grid();

        $this->setModel($grid);
        $this->buildColumns($grid);
        $this->buildFilters($grid);

        return $grid;
    }

    public function setModel(Grid $grid): void
    {
        $grid->setModel($this->accountRepository->gridCollection());
        $grid->setDefaultPerPage(30);
        $grid->setFilterRenderType(Filter::RENDER_INNER);
        $customization = new Customization($grid);
        $customization->setButtonClass('btn-outline-primary');
        $grid->setTemplateFile(__DIR__ . '/templates/default.latte');
        $grid->setCustomization($customization);
    }

    public function buildColumns(Grid $grid): void
    {
        $grid->addColumnText(self::EMAIL, 'Email');
        $grid->addColumnText(self::ROLE, 'Role');
        $grid->addColumnText(self::NAME, 'Jméno');
        $grid->addColumnText(self::LASTNAME, 'Příjmení');
        $grid->addColumnText(self::IS_ACTIVE, 'Aktivní')
            ->setCustomRender(function (Row $row) {
                return Html::el('p')
                    ->setAttribute('class', 'badge badge-' . ($row['is_active'] ? 'success' : 'danger'))
                    ->setText($row['is_active'] ? 'Aktivní' : 'Neaktivní');
            });
    }

    private function buildFilters(Grid $grid): void
    {
        $grid->addFilterText(self::EMAIL, 'Email');
        $grid->addFilterText(self::ROLE, 'Role');
        $grid->addFilterText(self::NAME, 'Jméno')
            ->setWhere(function (string $name, Fluent $fluent) {
                $fluent->where('lower(s.first_name) LIKE %~like~', $name);
            });
        $grid->addFilterText(self::LASTNAME, 'Příjmení')
            ->setWhere(function (string $name, Fluent $fluent) {
                $fluent->where('lower(s.last_name) LIKE %~like~', $name);
            });
        $grid->addFilterSelect(self::IS_ACTIVE, 'Aktivní', ['' => '---', 'bool_0' => 'NE', 'bool_1' => 'ANO'])
            ->setWhere(function (string $value, Fluent $fluent) {
                $fluent->where('a.is_active = %i', $value === 'bool_1');
            });
    }

}