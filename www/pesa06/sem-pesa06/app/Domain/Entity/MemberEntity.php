<?php
declare(strict_types=1);

namespace App\Domain\Entity;


use DateTime;
use LeanMapper\Entity;

class MemberEntity extends Entity
{
    public const ID = 'id';
    public const FIRST_NAME = 'first_name';
    public const LAST_NAME = 'last_name';
    public const FACR_ID = 'facr_id';
    public const YEAR_OF_BIRTH = 'year_of_birth';
    public const CREATED_AT = 'created_at';
    public const CREATED_BY = 'created_by';
    public const MODIFIED_AT = 'modified_at';
    public const MODIFIED_BY = 'modified_by';
    public const EMAIL = 'email';

    public function getId(): int
    {
        return $this->row->{self::ID};
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

    public function getFacrId(): string
    {
        return $this->row->{self::FACR_ID};
    }

    public function setFacrId(string $facrId): void
    {
        $this->row->{self::FACR_ID} = $facrId;
    }

    public function getYearOfBirth(): int
    {
        return $this->row->{self::YEAR_OF_BIRTH};
    }

    public function setYearOfBirth(int $yearOfBirth): void
    {
        $this->row->{self::YEAR_OF_BIRTH} = $yearOfBirth;
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

    public function getEmail(): ?string
    {
        return $this->row->{self::EMAIL};
    }

    public function setEmail(?string $email): void
    {
        $this->row->{self::EMAIL} = $email;
    }

}