<?php
declare(strict_types=1);

namespace App\Handler;


use App\Handler\Exception\DeletePositionHandlerException;
use Domain\Entity\StaffEntity;
use Domain\Entity\StaffPositionTeamEntity;
use Domain\Repository\PositionRepository;
use Domain\Repository\StaffPositionTeamRepository;
use Domain\Repository\StaffRepository;
use Domain\Repository\TeamRepository;

class DeletePositionHandler
{
    private PositionRepository $positionRepository;
    private StaffPositionTeamRepository $staffPositionTeamRepository;
    private TeamRepository $teamRepository;
    private StaffRepository $staffRepository;

    public function __construct(
        PositionRepository $positionRepository,
        StaffPositionTeamRepository $staffPositionTeamRepository,
        TeamRepository $teamRepository,
        StaffRepository $staffRepository
    ) {
        $this->positionRepository = $positionRepository;
        $this->staffPositionTeamRepository = $staffPositionTeamRepository;
        $this->teamRepository = $teamRepository;
        $this->staffRepository = $staffRepository;
    }

    public function handle(int $positionId): void
    {
        $position = $this->positionRepository->find($positionId);
        if ($position === null) {
            throw new DeletePositionHandlerException('Position not found!');
        }
        $staffPositions = $this->staffPositionTeamRepository->findByPositionId($positionId);
        if (count($staffPositions) > 0) {
            $staffers = [];
            $teams = [];
            /** @var StaffPositionTeamEntity $staffPosition */
            foreach ($staffPositions as $staffPosition) {
                /** @var StaffEntity $staff */
                $staff = $this->staffRepository->find($staffPosition->getStaffId());
                $staffers[] = $staff->getFirstName() . ' ' . $staff->getLastName();
                if ($staffPosition->getTeamId() !== null) {
                    $teams[] = $this->teamRepository->find($staffPosition->getTeamId())->getName();
                }
            }
            throw new DeletePositionHandlerException('Position ' . $position->getName() . ' cannot be deleted, because it is still used. Staffers with this position: ' . implode(', ', $staffers) . ' teams: ' . implode(', ', $teams));
        }
        $this->positionRepository->delete($position);
    }
}