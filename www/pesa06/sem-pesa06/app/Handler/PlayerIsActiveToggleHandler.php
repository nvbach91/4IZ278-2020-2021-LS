<?php
declare(strict_types=1);

namespace App\Handler;


use App\Domain\Repository\PlayerRepository;
use App\Handler\Exception\PlayerIsActiveToggleHandlerException;

class PlayerIsActiveToggleHandler
{
    private PlayerRepository $playerRepository;

    public function __construct(
        PlayerRepository $playerRepository
    ) {
        $this->playerRepository = $playerRepository;
    }

    public function handle(int $playerId): void
    {
        $player = $this->playerRepository->findById($playerId);
        if ($player === null) {
            throw new PlayerIsActiveToggleHandlerException('Player not found!');
        }
        $player->setIsActive(!$player->isActive());
        $this->playerRepository->persist($player);
    }

}