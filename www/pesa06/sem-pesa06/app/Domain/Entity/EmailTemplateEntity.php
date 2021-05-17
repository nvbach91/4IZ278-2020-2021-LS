<?php
declare(strict_types=1);

namespace Domain\Entity;


use DateTime;
use LeanMapper\Entity;

class EmailTemplateEntity extends Entity
{
    public const ID = 'id';
    public const TITLE = 'title';
    public const VALUE = 'value';
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

    public function getTitle(): string
    {
        return $this->row->{self::TITLE};
    }

    public function setTitle(string $title): void
    {
        $this->row->{self::TITLE} = $title;
    }

    public function getValue(): string
    {
        return $this->row->{self::VALUE};
    }

    public function setValue(string $value): void
    {
        $this->row->{self::VALUE} = $value;
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