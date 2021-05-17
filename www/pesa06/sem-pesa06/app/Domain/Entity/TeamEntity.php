<?php
declare(strict_types=1);

namespace App\Domain\Entity;


use DateTime;
use LeanMapper\Entity;

class TeamEntity extends Entity
{
    public const ID = 'id';
    public const NAME = 'name';
    public const COMPETITION = 'competition';
    public const AGE_UNDER = 'age_under';
    public const IS_YOUTH = 'is_youth';
    public const CREATED_AT = 'created_at';
    public const CREATED_BY = 'created_by';
    public const MODIFIED_AT = 'modified_at';
    public const MODIFIED_BY = 'modified_by';

    public function getId(): int
    {
        return $this->row->{self::ID};
    }

    public function setId(int $id): void
    {
        $this->row->{self::ID} = $id;
    }

    public function getName(): string
    {
        return $this->row->{self::NAME};
    }

    public function setName(string $name): void
    {
        $this->row->{self::NAME} = $name;
    }

    public function getCompetition(): string
    {
        return $this->row->{self::COMPETITION};
    }

    public function setCompetition(string $competition): void
    {
        $this->row->{self::COMPETITION} = $competition;
    }

    public function getAgeUnder(): ?int
    {
        return $this->row->{self::AGE_UNDER};
    }

    public function setAgeUnder(?int $ageUnder): void
    {
        $this->row->{self::AGE_UNDER} = $ageUnder;
    }

    public function isYouth(): bool
    {
        return (bool)$this->row->{self::IS_YOUTH};
    }

    public function setIsYouth(bool $isYouth): void
    {
        $this->row->{self::IS_YOUTH} = $isYouth;
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