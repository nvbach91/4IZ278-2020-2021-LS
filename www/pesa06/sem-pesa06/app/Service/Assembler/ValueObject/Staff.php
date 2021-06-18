<?php
declare(strict_types=1);

namespace App\Service\Assembler\ValueObject;


class Staff
{
    private int $id;
    private string $name;
    private ?string $facrId;
    private ?string $email;
    private string $position;
    private ?int $memberId;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getFacrId(): ?string
    {
        return $this->facrId;
    }

    /**
     * @param string|null $facrId
     */
    public function setFacrId(?string $facrId): void
    {
        $this->facrId = $facrId;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition(string $position): void
    {
        $this->position = $position;
    }

    /**
     * @return int|null
     */
    public function getMemberId(): ?int
    {
        return $this->memberId;
    }

    /**
     * @param int|null $memberId
     */
    public function setMemberId(?int $memberId): void
    {
        $this->memberId = $memberId;
    }

}