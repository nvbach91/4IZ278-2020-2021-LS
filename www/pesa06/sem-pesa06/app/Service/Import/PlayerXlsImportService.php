<?php
declare(strict_types=1);

namespace App\Service\Import;


use Domain\Entity\MemberEntity;
use Domain\Entity\PlayerEntity;
use Domain\Repository\MemberRepository;
use Domain\Repository\PlayerRepository;
use Nette\Utils\FileSystem;
use PhpOffice\PhpSpreadsheet\Reader\Xls;

class PlayerXlsImportService
{

    private PlayerRepository $playerRepository;
    private MemberRepository $memberRepository;

    public function __construct(
        PlayerRepository $playerRepository,
        MemberRepository $memberRepository
    ) {
        $this->playerRepository = $playerRepository;
        $this->memberRepository = $memberRepository;
    }



    public function import(): void
    {
        $reader = new Xls();
        $reader->setReadDataOnly(true);
        $xls = $reader->load(FileSystem::normalizePath(__DIR__ . '/../../../files/seznam-hracu.xls'));
        $sheet = $xls->getActiveSheet();

        foreach ($sheet->getRowIterator() as $row){
            if ($row->getRowIndex() === 1){
                continue;
            }
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            $member = null;
            $player = null;
            $memberStored = false;
            $playerFound = false;
            foreach ($cellIterator as $cell){
                if ($playerFound === true){
                    break;
                }
                switch ($cell->getColumn()){
                    case 'A':
                        $member = $this->memberRepository->findByFacrId((int)$cell->getValue());
                        if ($member !== null){
                            $memberStored = true;
                            $player = $this->playerRepository->findPlayerByMemberId($member->getId());
                            if ($player !== null){
                                $playerFound = true;
                                break;
                            }
                            $player = new PlayerEntity();
                            break;
                        }
                        $member = new MemberEntity();
                        $member->setFacrId($cell->getValue());
                        $player = new PlayerEntity();
                        break;
                    case 'C':
                        if ($memberStored === true){
                            break;
                        }
                        $member->setFirstName($cell->getValue());
                        break;
                    case 'B':
                        if ($memberStored === true){
                            break;
                        }
                        $member->setLastName($cell->getValue());
                        break;
                    case 'D':
                        if ($memberStored === true){
                            break;
                        }
                        $member->setYearOfBirth((int)$cell->getValue());
                        break;
                    case 'H':
                        $player->setIsActive($cell->getValue() === 'ano');
                        break;
                }
            }
            if ($memberStored === false) {
                $member->setCreatedAt(new \DateTime());
                $member->setCreatedBy('IS FACR import');
                $this->memberRepository->store($member);
            }
            if ($playerFound === false){
                $team = $this->playerRepository->findTeamByYear($member->getYearOfBirth());
                $player->setCreatedAt(new \DateTime());
                $player->setCreatedBy('IS FACR import');
                $player->setMemberId($member->getId());
                $player->setTeamId($team === null ? null : $team->getId());
                $this->playerRepository->persist($player);
            }
        }
    }

}