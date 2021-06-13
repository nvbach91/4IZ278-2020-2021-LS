<?php
declare(strict_types=1);

namespace Domain\Entity;

use DateTime;
use LeanMapper\Entity;

class PositionEntity extends Entity
{
    public const ID = 'id';
    public const NAME = 'name';
    public const CREATED = 'created';
    public const CREATED_BY = 'created_by';

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

}