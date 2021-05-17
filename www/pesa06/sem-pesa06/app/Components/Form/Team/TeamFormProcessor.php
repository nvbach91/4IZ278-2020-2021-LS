<?php
declare(strict_types=1);

namespace App\Components\Form\Team;


use Domain\Entity\TeamEntity;
use Domain\Repository\TeamRepository;
use Nette\Application\UI\Form;

class TeamFormProcessor
{
    private TeamRepository $teamRepository;

    public function __construct(
        TeamRepository $teamRepository
    ) {
        $this->teamRepository = $teamRepository;
    }


    public function process(Form $form): int
    {
        $values = $form->getValues();

        $storedTeam = $this->teamRepository->findById((int)$values[TeamFormFactory::ID]);
        $team = $storedTeam === null ? new TeamEntity() : $storedTeam;

        $team->setName($values[TeamFormFactory::NAME]);
        $team->setCompetition($values[TeamFormFactory::COMPETITION]);
        $team->setAgeUnder(empty($values[TeamFormFactory::AGE_UNDER]) ? null : (int)$values[TeamFormFactory::AGE_UNDER]);
        $team->setIsYouth($values[TeamFormFactory::IS_YOUTH]);

        if ($storedTeam === null) {
            $team->setCreatedAt(new \DateTime());
            $team->setCreatedBy('admin');
            $this->teamRepository->store($team);
            return $team->getId();
        }

        $team->setModifiedAt(new \DateTime());
        $team->setModifiedBy('admin');
        $this->teamRepository->store($team);
        return $team->getId();
    }
}