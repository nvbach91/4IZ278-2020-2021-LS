<?php
declare(strict_types=1);

namespace App\Presenters;


use App\Components\Form\Staff\StaffUpsertFormFactory;
use App\Components\Grid\StaffGridBuilder;
use Domain\Repository\TeamRepository;
use Nette\Application\UI\Form;
use Nette\ComponentModel\IComponent;

class StaffPresenter extends LayoutPresenter
{
    private StaffGridBuilder $staffGridBuilder;
    private StaffUpsertFormFactory $staffUpsertFormFactory;

    public function __construct(
        StaffGridBuilder $staffGridBuilder,
        StaffUpsertFormFactory $staffUpsertFormFactory,
        TeamRepository $teamRepository
    )
    {
        parent::__construct($teamRepository);
        $this->staffGridBuilder = $staffGridBuilder;
        $this->staffUpsertFormFactory = $staffUpsertFormFactory;
    }

    public function createComponentStaffGrid(): IComponent
    {
        return $this->staffGridBuilder->create();
    }

    public function createComponentStaffUpsertForm(): Form
    {
        return $this->staffUpsertFormFactory->create();
    }

    public function actionUpsert(?int $staffId): void
    {

    }


}