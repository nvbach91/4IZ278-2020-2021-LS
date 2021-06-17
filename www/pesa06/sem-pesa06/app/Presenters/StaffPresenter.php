<?php
declare(strict_types=1);

namespace App\Presenters;


use App\Components\Form\Staff\StaffAddPositionFormFactory;
use App\Components\Form\Staff\StaffUpsertFormFactory;
use App\Components\Grid\StaffGridBuilder;
use App\Components\Grid\StaffPositionGridBuilder;
use App\Domain\Enum\RoleEnum;
use App\Handler\DeleteStaffPositionTeamPairingHandler;
use App\Handler\Exception\DeleteStaffPositionTeamPairingHandlerException;
use Nette\Application\UI\Form;
use Nette\ComponentModel\IComponent;

class StaffPresenter extends LayoutPresenter
{
    private StaffGridBuilder $staffGridBuilder;
    private StaffUpsertFormFactory $staffUpsertFormFactory;
    private StaffAddPositionFormFactory $staffAddPositionFormFactory;
    private StaffPositionGridBuilder $staffPositionGridBuilder;
    private DeleteStaffPositionTeamPairingHandler $deleteStaffPositionTeamPairingHandler;

    public function __construct(
        StaffGridBuilder $staffGridBuilder,
        StaffUpsertFormFactory $staffUpsertFormFactory,
        StaffAddPositionFormFactory $staffAddPositionFormFactory,
        StaffPositionGridBuilder $staffPositionGridBuilder,
        DeleteStaffPositionTeamPairingHandler $deleteStaffPositionTeamPairingHandler
    )
    {
        parent::__construct();
        $this->staffGridBuilder = $staffGridBuilder;
        $this->staffUpsertFormFactory = $staffUpsertFormFactory;
        $this->staffAddPositionFormFactory = $staffAddPositionFormFactory;
        $this->staffPositionGridBuilder = $staffPositionGridBuilder;
        $this->deleteStaffPositionTeamPairingHandler = $deleteStaffPositionTeamPairingHandler;
    }

    public function beforeRender(): void
    {
        parent::beforeRender();
        $isAdmin = false;
        foreach ($this->user->getRoles() as $role) {
            if ($role === RoleEnum::ROLE_ADMIN) {
                $isAdmin = true;
            }
        }
        if ($isAdmin === false) {
            $this->flashMessage('Na tuto akci nemáš oprávnění!', 'alert alert-danger');
            $this->redirect('Article:default');
        }
    }

    public function createComponentStaffGrid(): IComponent
    {
        return $this->staffGridBuilder->create();
    }

    public function createComponentStaffUpsertForm(): Form
    {
        return $this->staffUpsertFormFactory->create();
    }

    public function actionUpsert(?string $staffId): void
    {
        $this->template->staffId = $staffId;
    }

    public function createComponentAddPositionForm(): Form
    {
        return $this->staffAddPositionFormFactory->create();
    }

    public function actionAddPosition(int $staffId, ?int $pairindIg): void
    {

    }

    public function actionRemovePosition(int $pairingId, int $staffId): void
    {
        try {
            $this->deleteStaffPositionTeamPairingHandler->handle($pairingId);
        } catch (DeleteStaffPositionTeamPairingHandlerException $e) {
            $this->flashMessage($e->getMessage(), 'alert alert-danger');
        }
        $this->redirect('Staff:upsert', ['staffId' => $staffId]);
    }

    public function createComponentStaffPositionGrid(): IComponent
    {
        return $this->staffPositionGridBuilder->build();
    }
}