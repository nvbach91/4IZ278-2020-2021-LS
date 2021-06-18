<?php
declare(strict_types=1);

namespace App\Handler;


use App\Handler\Exception\DeleteStaffPositionTeamPairingHandlerException;
use Domain\Repository\StaffPositionTeamRepository;
use LeanMapper\Exception\InvalidStateException;

class DeleteStaffPositionTeamPairingHandler
{
    private StaffPositionTeamRepository $staffPositionTeamRepository;

    public function __construct(
        StaffPositionTeamRepository $staffPositionTeamRepository
    ) {
        $this->staffPositionTeamRepository = $staffPositionTeamRepository;
    }

    public function handle(int $pairingId): void
    {
        $pairing = $this->staffPositionTeamRepository->find($pairingId);
        if ($pairing === null) {
            throw new DeleteStaffPositionTeamPairingHandlerException('Pairing not found!');
        }
        try {
            $this->staffPositionTeamRepository->delete($pairing);
        } catch (InvalidStateException $e) {
            throw new DeleteStaffPositionTeamPairingHandlerException($e->getMessage());
        }
    }
}