<?php
declare(strict_types=1);

namespace App\Service\Assembler\ValueObject;


class Team
{
    private array $players;
    private array $staff;
    private int $teamId;
    private string $competition;
    private ?int $ageUnder;
    private bool $isYouth;
    private string $name;

    public function toArray(): array
    {
        return [
            'id' => $this->getTeamId(),
            'competition' => $this->getCompetition(),
            'ageUnder' => $this->getAgeUnder(),
            'isYouth' => $this->isYouth(),
            'name' => $this->getName(),
            'staff' => array_map(function (Staff $staff) {
                return [
                    'id' => $staff->getId(),
                    'facrId' => $staff->getFacrId(),
                    'position' => $staff->getPosition(),
                    'email' => $staff->getEmail(),
                    'memberId' => $staff->getMemberId(),
                    'name' => $staff->getName(),
                ];
            }, $this->getStaff()),
            'players' => array_map(function (Player $player) {
                return [
                    'id' => $player->getId(),
                    'name' => $player->getName(),
                    'facrId' => $player->getFacrId(),
                    'yearOfBirth' => $player->getYearOfBirth(),
                    'email' => $player->getEmail(),
                    'memberId' => $player->getMemberId(),
                ];
            }, $this->getPlayers()),
        ];
    }

    /**
     * @return array
     */
    public function getPlayers(): array
    {
        return $this->players;
    }

    /**
     * @param array $players
     */
    public function setPlayers(array $players): void
    {
        $this->players = $players;
    }

    /**
     * @return array
     */
    public function getStaff(): array
    {
        return $this->staff;
    }

    /**
     * @param array $staff
     */
    public function setStaff(array $staff): void
    {
        $this->staff = $staff;
    }

    /**
     * @return int
     */
    public function getTeamId(): int
    {
        return $this->teamId;
    }

    /**
     * @param int $teamId
     */
    public function setTeamId(int $teamId): void
    {
        $this->teamId = $teamId;
    }

    /**
     * @return string
     */
    public function getCompetition(): string
    {
        return $this->competition;
    }

    /**
     * @param string $competition
     */
    public function setCompetition(string $competition): void
    {
        $this->competition = $competition;
    }

    /**
     * @return int|null
     */
    public function getAgeUnder(): ?int
    {
        return $this->ageUnder;
    }

    /**
     * @param int|null $ageUnder
     */
    public function setAgeUnder(?int $ageUnder): void
    {
        $this->ageUnder = $ageUnder;
    }

    /**
     * @return bool
     */
    public function isYouth(): bool
    {
        return $this->isYouth;
    }

    /**
     * @param bool $isYouth
     */
    public function setIsYouth(bool $isYouth): void
    {
        $this->isYouth = $isYouth;
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




}