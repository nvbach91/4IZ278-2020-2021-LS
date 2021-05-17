<?php
declare(strict_types=1);

namespace Domain\Entity;


use DateTime;
use LeanMapper\Entity;

class PlayerEntity extends Entity
{
    public const ID = 'id';
    public const MEMBER_ID = 'member_id';
    public const TEAM_ID = 'team_id';
    public const IS_ACTIVE = 'is_active';
    public const CREATED_AT = 'created_at';
    public const CREATED_BY = 'created_by';
    public const MODIFIED_AT = 'modified_at';
    public const MODIFIED_BY = 'modified_by';

    public function getId(): int
    {
        return (int)$this->row->{self::ID};
    }

    public function setId(int $id): void
    {
        $this->row->{self::ID} = $id;
    }

    public function getMemberId(): int
    {
        return (int)$this->row->{self::MEMBER_ID};
    }

    public function setMemberId(int $memberId): void
    {
        $this->row->{self::MEMBER_ID} = $memberId;
    }

    public function getTeamId(): ?int
    {
        return $this->row->{self::TEAM_ID};
    }

    public function setTeamId(?int $teamId): void
    {
        $this->row->{self::TEAM_ID} = $teamId;
    }

    public function isActive(): bool
    {
        return (bool)$this->row->{self::IS_ACTIVE};
    }

    public function setIsActive(bool $isActive): void
    {
        $this->row->{self::IS_ACTIVE} = $isActive;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->row->{self::CREATED_AT};
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->row->{self::CREATED_AT} = $createdAt;
    }

    public function getCreatedBy(): string
    {
        return $this->row->{self::CREATED_BY};
    }

    public function setCreatedBy(string $createdBy): void
    {
        $this->row->{self::CREATED_BY} = $createdBy;
    }

    public function getModifiedAt(): ?DateTime
    {
        return $this->row->{self::MODIFIED_AT};
    }

    public function setModifiedAt(?DateTime $modifiedAt): void
    {
        $this->row->{self::MODIFIED_AT} = $modifiedAt;
    }

    public function getModifiedBy(): ?string
    {
        return $this->row->{self::MODIFIED_BY};
    }

    public function setModifiedBy(string $modifiedBy): void
    {
        $this->row->{self::MODIFIED_BY} = $modifiedBy;
    }

}