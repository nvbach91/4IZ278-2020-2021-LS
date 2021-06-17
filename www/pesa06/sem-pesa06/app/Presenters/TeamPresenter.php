<?php
declare(strict_types=1);

namespace App\Presenters;


use App\Components\Form\Team\TeamFormFactory;
use App\Components\Grid\TeamGridBuilder;
use App\Domain\Enum\RoleEnum;
use Domain\Repository\TeamRepository;
use App\Service\Assembler\TeamAssembler;
use Nette\Application\UI\Form;
use Nette\ComponentModel\IComponent;

class TeamPresenter extends LayoutPresenter
{
    private TeamGridBuilder $teamGridBuilder;
    private TeamFormFactory $teamFormFactory;
    private TeamAssembler $teamAssembler;

    public function __construct(
        TeamGridBuilder $teamGridBuilder,
        TeamFormFactory $teamFormFactory,
        TeamRepository $teamRepository,
        TeamAssembler $teamAssembler
    )
    {
        parent::__construct($teamRepository);
        $this->teamGridBuilder = $teamGridBuilder;
        $this->teamFormFactory = $teamFormFactory;
        $this->teamAssembler = $teamAssembler;
    }

    public function createComponentTeamGrid(): IComponent
    {
        return $this->teamGridBuilder->create();
    }

    public function createComponentUpsertTeamForm(): Form
    {
        return $this->teamFormFactory->create();
    }

    public function actionDetail(int $teamId): void
    {
        $team = $this->teamAssembler->assembly($teamId);
        if ($team === null) {
            $this->flashMessage('Team not found!', 'alert alert-danger');
            $this->redirect('default');
        }
        $this->template->team = $team->toArray();
    }

    public function actionUpsert(?int $teamId): void
    {
        $isAdmin = false;
        foreach ($this->user->getRoles() as $role) {
            if ($role === RoleEnum::ROLE_ADMIN) {
                $isAdmin = true;
            }
        }
        if ($isAdmin === false) {
            $this->flashMessage('Na tuto akci nemáš oprávnění!', 'alert alert-danger');
            $this->redirect('Team:default');
        }
    }

}