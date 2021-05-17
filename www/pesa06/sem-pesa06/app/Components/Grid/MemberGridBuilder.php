<?php
declare(strict_types=1);

namespace App\Components\Grid;


use Domain\Entity\MemberEntity;
use Domain\Repository\MemberRepository;
use Dibi\Row;
use Grido\Components\Filters\Filter;
use Grido\Customization;
use Grido\Grid;
use Nette\Application\LinkGenerator;
use Nette\ComponentModel\IComponent;
use Nette\Utils\Html;

class MemberGridBuilder
{
    private const FIRST_NAME = 'first_name';
    private const LAST_NAME = 'last_name';
    private const FACR_ID = 'facr_id';
    private const YEAR_OF_BIRTH = 'year_of_birth';
    private const UPSERT_MEMBER = 'upsert_member';
    private const EMAIL = 'email';

    private MemberRepository $memberRepository;
    private LinkGenerator $linkGenerator;

    public function __construct(
        MemberRepository $memberRepository,
        LinkGenerator $linkGenerator
    )
    {
        $this->memberRepository = $memberRepository;
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
        $grid->setModel($this->memberRepository->collection());
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
        $grid->addColumnText(self::FACR_ID, 'FAČR ID')
            ->setSortable();
        $grid->addColumnText(self::YEAR_OF_BIRTH, 'Rok narození')
            ->setSortable();
        $grid->addColumnText(self::EMAIL, 'Email')
            ->setSortable();
        $grid->addColumnText(self::UPSERT_MEMBER, '')
            ->setCustomRender(function (Row $row){
                return Html::el('a')
                    ->setAttribute('class', 'btn btn-outline-primary')
                    ->setText('Upravit clena')
                    ->href($this->linkGenerator->link('Backoffice:Member:upsert', ['memberId' => $row['id']]));
            });
    }

    private function buildFilters(Grid $grid): void
    {
        $grid->addFilterText(self::FIRST_NAME, 'Jméno');
        $grid->addFilterText(self::LAST_NAME, 'Příjmení');
        $grid->addFilterText(self::FACR_ID, 'FAČR ID');
        $grid->addFilterText(self::YEAR_OF_BIRTH, 'Rok narození');
    }


}