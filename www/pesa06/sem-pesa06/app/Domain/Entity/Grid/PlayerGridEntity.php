<?php
declare(strict_types=1);

namespace App\Domain\Entity\Grid;


use LeanMapper\Entity;

class PlayerGridEntity extends Entity
{
    public const ID = 'id';
    public const IS_ACTIVE = 'is_active';
    public const TEAM_ID = 'team_id';
    public const TEAM_NAME = 'team_name';
    public const MEMBER_ID = 'member_id';
    public const FIRST_NAME = 'first_name';
    public const LAST_NAME = 'last_name';
    public const FACR_ID = 'facr_id';

    public function getId(): int
    {
        return (int)$this->row->{self::ID};
    }

    public function setId(int $id): void
    {
        $this->row->{self::ID} = $id;
    }

    public function isActive(): bool
    {
        return (bool)$this->row->{self::IS_ACTIVE};
    }

    public function setIsActive(bool $isActive): void
    {
        $this->row->{self::IS_ACTIVE} = $isActive;
    }

    public function getTeamId(): ?int
    {
        return $this->row->{self::TEAM_ID};
    }

    public function setTeamId(?int $teamId): void
    {
        $this->row->{self::TEAM_ID} = $teamId;
    }

    public function getTeamName(): ?string
    {
        return $this->row->{self::TEAM_NAME};
    }

    public function setTeamName(?string $teamName): void
    {
        $this->row->{self::TEAM_NAME} = $teamName;
    }

    public function getMemberId(): int
    {
        return (int)$this->row->{self::MEMBER_ID};
    }

    public function setMemberId(int $memberId): void
    {
        $this->row->{self::MEMBER_ID} = $memberId;
    }

    public function getFirstName(): string
    {
        return $this->row->{self::FIRST_NAME};
    }

    public function setFirstName(string $firstName): void
    {
        $this->row->{self::FIRST_NAME} = $firstName;
    }

    public function getLastName(): string
    {
        return $this->row->{self::LAST_NAME};
    }

    public function setLastName(string $lastName): void
    {
        $this->row->{self::LAST_NAME} = $lastName;
    }

    public function getFacrId(): int
    {
        return (int)$this->row->{self::FACR_ID};
    }

    public function setFacrId(int $facrId): void
    {
        $this->row->{self::FACR_ID} = $facrId;
    }

}