<?php
declare(strict_types=1);

namespace App\Handler;


use App\Domain\Entity\PlayerEntity;
use App\Domain\Repository\MemberRepository;
use App\Domain\Repository\PlayerRepository;

class AssignPlayersToTeamsHandler
{
    private PlayerRepository $playerRepository;
    private MemberRepository $memberRepository;

    public function __construct(
        PlayerRepository $playerRepository,
        MemberRepository $memberRepository
    ) {
        $this->memberRepository = $memberRepository;
        $this->playerRepository = $playerRepository;
    }

    public function handle(): void
    {
        $players = $this->playerRepository->getActivePlayers();
        /** @var PlayerEntity $player */
        foreach ($players as $player) {
            $member = $this->memberRepository->findById($player->getMemberId());
            $team = $this->playerRepository->findTeamByYear($member->getYearOfBirth());
            if ($team === null) {
                continue;
            }
            $player->setTeamId($team->getId());
            $this->playerRepository->persist($player);
        }
    }

}