<?php
declare(strict_types=1);

namespace App\Domain\Entity;


use DateTime;
use LeanMapper\Entity;

class DocumentEntity extends Entity
{
    public const ID = 'id';
    public const MEMBER_ID = 'member_id';
    public const TYPE = 'type';
    public const AMOUNT = 'amount';
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

    public function getMemberId(): int
    {
        return $this->row->{self::MEMBER_ID};
    }

    public function setMemberId(int $memberId): void
    {
        $this->row->{self::MEMBER_ID} = $memberId;
    }

    public function getType(): string
    {
        return $this->row->{self::TYPE};
    }

    public function setType(string $type): void
    {
        $this->row->{self::TYPE} = $type;
    }

    public function getAmount(): int
    {
        return $this->row->{self::AMOUNT};
    }

    public function setAmount(int $amount): void
    {
        $this->row->{self::AMOUNT} = $amount;
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