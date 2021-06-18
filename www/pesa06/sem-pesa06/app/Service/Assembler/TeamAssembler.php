<?php
declare(strict_types=1);

namespace App\Service\Assembler;


use Domain\Entity\PlayerEntity;
use Domain\Entity\StaffEntity;
use Domain\Repository\MemberRepository;
use Domain\Repository\PlayerRepository;
use Domain\Repository\StaffPositionTeamRepository;
use Domain\Repository\StaffRepository;
use Domain\Repository\TeamRepository;
use App\Service\Assembler\ValueObject\Player;
use App\Service\Assembler\ValueObject\Staff;
use App\Service\Assembler\ValueObject\Team;

class TeamAssembler
{
    private TeamRepository $teamRepository;
    private PlayerRepository $playerRepository;
    private StaffRepository $staffRepository;
    private MemberRepository $memberRepository;
    private StaffPositionTeamRepository $staffPositionTeamRepository;

    public function __construct(
        TeamRepository $teamRepository,
        PlayerRepository $playerRepository,
        StaffRepository $staffRepository,
        MemberRepository $memberRepository,
        StaffPositionTeamRepository $staffPositionTeamRepository
    ) {
        $this->teamRepository = $teamRepository;
        $this->playerRepository = $playerRepository;
        $this->staffRepository = $staffRepository;
        $this->memberRepository = $memberRepository;
        $this->staffPositionTeamRepository = $staffPositionTeamRepository;
    }

    public function assembly(int $teamId): ?Team
    {
        $teamEntity = $this->teamRepository->findById($teamId);
        if ($teamEntity === null) {
            return null;
        }
        $team = new Team();
        $team->setTeamId($teamId);
        $team->setIsYouth($teamEntity->isYouth());
        $team->setAgeUnder($teamEntity->getAgeUnder());
        $team->setCompetition($teamEntity->getCompetition());
        $team->setName($teamEntity->getName());
        $team->setPlayers(array_map(function (PlayerEntity $entity) {
            $member = $this->memberRepository->findById($entity->getMemberId());
            $player = new Player();
            $player->setId($entity->getId());
            $player->setFacrId($member->getFacrId());
            $player->setMemberId($member->getId());
            $player->setName($member->getFirstName() . ' ' . $member->getLastName());
            $player->setEmail($member->getEmail());
            $player->setYearOfBirth($member->getYearOfBirth());
            return $player;
        }, $this->playerRepository->findByTeamId($teamId)));
        $team->setStaff(array_map(function (StaffEntity $entity) use ($teamId) {
            $member = null;
            if ($entity->getMemberId() !== null) {
                $member = $this->memberRepository->findById($entity->getMemberId());
            }
            $staff = new Staff();
            $staff->setId($entity->getId());
            $staff->setName($entity->getFirstName() . ' ' . $entity->getLastName());
            $staff->setMemberId($entity->getMemberId());
            $staff->setFacrId($member === null ? null : $member->getFacrId());
            $positionArray = [];
            $positions = $this->staffPositionTeamRepository->findPositionNamesByStaffIdAndTeamId($entity->getId(), $teamId);
            foreach ($positions as $position) {
                $positionArray[] = $position['name'];
            }
            $staff->setPosition(implode(', ', $positionArray));
            $staff->setEmail($member === null ? null : $member->getEmail());
            return $staff;
        }, $this->staffRepository->findByTeamId($teamId)));
        return $team;
    }


}