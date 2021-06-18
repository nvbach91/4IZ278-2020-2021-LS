<?php
declare(strict_types=1);

namespace App\Service\Assembler\ValueObject;


class Player
{
    private int $id;
    private string $name;
    private int $yearOfBirth;
    private string $facrId;
    private ?string $email;
    private int $memberId;

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
     * @return int
     */
    public function getYearOfBirth(): int
    {
        return $this->yearOfBirth;
    }

    /**
     * @param int $yearOfBirth
     */
    public function setYearOfBirth(int $yearOfBirth): void
    {
        $this->yearOfBirth = $yearOfBirth;
    }

    /**
     * @return string
     */
    public function getFacrId(): string
    {
        return $this->facrId;
    }

    /**
     * @param string $facrId
     */
    public function setFacrId(string $facrId): void
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
     * @return int
     */
    public function getMemberId(): int
    {
        return $this->memberId;
    }

    /**
     * @param int $memberId
     */
    public function setMemberId(int $memberId): void
    {
        $this->memberId = $memberId;
    }



}