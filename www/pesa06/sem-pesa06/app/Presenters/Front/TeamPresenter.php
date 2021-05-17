<?php
declare(strict_types=1);

namespace App\Presenters\Front;


use App\Components\Form\Team\TeamFormFactory;
use App\Components\Grid\TeamGridBuilder;
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
        $this->template->team = $this->teamAssembler->assembly($teamId)->toArray();
    }

}