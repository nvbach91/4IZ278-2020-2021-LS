<?php
declare(strict_types=1);

namespace App\Components\Grid;


use App\Domain\Enum\DocumentTypeEnum;
use Dibi\Fluent;
use Dibi\Row;
use Domain\Repository\DocumentRepository;
use Grido\Components\Filters\Filter;
use Grido\Customization;
use Grido\Grid;
use Nette\Application\LinkGenerator;
use Nette\ComponentModel\IComponent;
use Nette\Utils\Html;

class DocumentGridBuilder
{
    private const TYPE = 'type';
    private const CREATED = 'created';
    private const AMOUNT = 'amount';
    private const RECIPIENT = 'recipient';
    private const CREATED_BY = 'created_by';
    private const EXPORT = 'export';

    private DocumentRepository $documentRepository;
    private LinkGenerator $linkGenerator;

    public function __construct(
        DocumentRepository $documentRepository,
        LinkGenerator $linkGenerator
    ) {
        $this->documentRepository = $documentRepository;
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

    private function setModel(Grid $grid): void
    {
        $grid->setModel($this->documentRepository->gridCollection());
        $grid->setDefaultPerPage(30);
        $grid->setFilterRenderType(Filter::RENDER_INNER);
        $customization = new Customization($grid);
        $customization->setButtonClass('btn-outline-primary');
        $customization->useTemplateBootstrap();
        $grid->setCustomization($customization);
    }

    private function buildColumns(Grid $grid): void
    {
        $grid->addColumnText(self::RECIPIENT, 'Příjemce');
        $grid->addColumnText(self::TYPE, 'Typ dokumentu');
        $grid->addColumnText(self::AMOUNT, 'Částka');
        $grid->addColumnText(self::CREATED, 'Vytvořeno')
            ->setCustomRender(function (Row $row) {
                return Html::el('p')
                    ->setText($row['created']->format('d. m. Y'));
            });
        $grid->addColumnText(self::CREATED_BY, 'Vytvořil');
        $grid->addColumnText(self::EXPORT, 'Exportovat do PDF')
            ->setCustomRender(function (Row $row) {
                return Html::el('a')
                    ->setAttribute('class', 'btn btn-sm btn-outline-primary')
                    ->setText('Exportovat do PDF')
                    ->href($this->linkGenerator->link('Backoffice:Document:export', ['documentId' => $row['id']]));
            });
    }

    private function buildFilters(Grid $grid): void
    {
        $grid->addFilterText(self::RECIPIENT, '')
            ->setWhere(function (string $value, Fluent $fluent) {
                $fluent->where('m.last_name LIKE %~like~', $value);
            });
        $grid->addFilterSelect(self::TYPE, 'Typ dokumentu', ['' => '---', DocumentTypeEnum::FAKTURA => DocumentTypeEnum::FAKTURA, DocumentTypeEnum::PRISPEVKY => DocumentTypeEnum::PRISPEVKY]);
    }

}