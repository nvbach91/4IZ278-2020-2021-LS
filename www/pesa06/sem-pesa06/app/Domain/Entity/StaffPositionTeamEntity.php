<?php
declare(strict_types=1);

namespace Domain\Entity;


use LeanMapper\Entity;

class StaffPositionTeamEntity extends Entity
{
    public const ID = 'id';
    public const STAFF_ID = 'staff_id';
    public const POSITION_ID = 'position_id';
    public const TEAM_ID = 'team_id';

    public function getId(): int
    {
        return $this->row->{self::ID};
    }

    public function setId(int $id): void
    {
        $this->row->{self::ID} = $id;
    }

    public function getStaffId(): int
    {
        return $this->row->{self::STAFF_ID};
    }

    public function setStaffId(int $staffId): void
    {
        $this->row->{self::STAFF_ID} = $staffId;
    }

    public function getPositionId(): int
    {
        return $this->row->{self::POSITION_ID};
    }

    public function setPositionId(int $positionId): void
    {
        $this->row->{self::POSITION_ID} = $positionId;
    }

    public function getTeamId(): ?int
    {
        return $this->row->{self::TEAM_ID};
    }

    public function setTeamId(?int $teamId): void
    {
        $this->row->{self::TEAM_ID} = $teamId;
    }
}