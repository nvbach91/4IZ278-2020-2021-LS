<?php
declare(strict_types=1);

namespace App\Components\Form\Staff;


use Domain\Entity\StaffPositionTeamEntity;
use Domain\Repository\StaffPositionTeamRepository;
use Nette\Application\UI\Form;

class StaffAddPositionFormProcessor
{
    private StaffPositionTeamRepository $staffPositionTeamRepository;

    public function __construct(
        StaffPositionTeamRepository $staffPositionTeamRepository
    ) {
        $this->staffPositionTeamRepository = $staffPositionTeamRepository;
    }

    public function process(Form $form): int
    {
        $values = $form->getValues();
        if ($values[StaffAddPositionFormFactory::ID]) {
            $pairing = $this->staffPositionTeamRepository->find((int)$values[StaffAddPositionFormFactory::ID]);
        } else {
            $pairing = new StaffPositionTeamEntity();
        }
        $teamId = $values[StaffAddPositionFormFactory::TEAM_ID];
        $pairing->setTeamId($teamId === '' ? null : (int)$teamId);
        $pairing->setPositionId((int)$values[StaffAddPositionFormFactory::POSITION_ID]);
        $pairing->setStaffId((int)$values[StaffAddPositionFormFactory::STAFF_ID]);
        $this->staffPositionTeamRepository->persist($pairing);
        return $pairing->getStaffId();
    }

}