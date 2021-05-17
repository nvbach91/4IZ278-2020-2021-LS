<?php
declare(strict_types=1);

namespace App\Domain\Entity;


use DateTime;
use LeanMapper\Entity;

class AccountEntity extends Entity
{
    public const ID = 'id';
    public const EMAIL = 'email';
    public const PASSWORD = 'password';
    public const STAFF_ID = 'staff_id';
    public const IS_ACTIVE = 'is_active';
    public const ROLE = 'role';
    public const CREATED = 'created';
    public const CREATED_BY = 'created_by';
    public const MODIFIED = 'modified';
    public const MODIFIED_BY = 'modified_by';

    public function getId(): int
    {
        return $this->row->{self::ID};
    }

    public function setId(int $id): void
    {
        $this->row->{self::ID} = $id;
    }

    public function getEmail(): string
    {
        return $this->row->{self::EMAIL};
    }

    public function setEmail(string $email): void
    {
        $this->row->{self::EMAIL} = $email;
    }

    public function getPassword(): string
    {
        return $this->row->{self::PASSWORD};
    }

    public function setPassword(string $password): void
    {
        $this->row->{self::PASSWORD} = $password;
    }

    public function getStaffId(): ?int
    {
        return $this->row->{self::STAFF_ID};
    }

    public function setStaffId(?int $staffId): void
    {
        $this->row->{self::STAFF_ID} = $staffId;
    }

    public function isActive(): bool
    {
        return (bool)$this->row->{self::IS_ACTIVE};
    }

    public function setIsActive(bool $isActive): void
    {
        $this->row->{self::IS_ACTIVE} = $isActive;
    }

    public function getRole(): string
    {
        return $this->row->{self::ROLE};
    }

    public function setRole(string $role): void
    {
        $this->row->{self::ROLE} = $role;
    }

    public function getCreated(): DateTime
    {
        return $this->row->{self::CREATED};
    }

    public function setCreated(DateTime $created): void
    {
        $this->row->{self::CREATED} = $created;
    }

    public function getCreatedBy(): string
    {
        return $this->row->{self::CREATED_BY};
    }

    public function setCreatedBy(string $createdBy): void
    {
        $this->row->{self::CREATED_BY} = $createdBy;
    }

    public function getModified(): ?DateTime
    {
        return $this->row->{self::MODIFIED};
    }

    public function setModified(?DateTime $modified): void
    {
        $this->row->{self::MODIFIED} = $modified;
    }

    public function getModifiedBy(): ?string
    {
        return $this->row->{self::MODIFIED_BY};
    }

    public function setModifiedBy(?string $modifiedBy): void
    {
        $this->row->{self::MODIFIED_BY} = $modifiedBy;
    }

}