<?php
declare(strict_types=1);

namespace Domain\Entity;


use DateTime;
use LeanMapper\Entity;

class StaffEntity extends Entity
{
    public const ID = 'id';
    public const FIRST_NAME = 'first_name';
    public const LAST_NAME = 'last_name';
    public const MEMBER_ID = 'member_id';
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

    public function getMemberId(): ?int
    {
        return $this->row->{self::MEMBER_ID};
    }

    public function setMemberId(?int $memberId): void
    {
        $this->row->{self::MEMBER_ID} = $memberId;
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