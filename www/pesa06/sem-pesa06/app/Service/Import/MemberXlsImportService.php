<?php
declare(strict_types=1);

namespace App\Service\Import;


use App\Domain\Entity\MemberEntity;
use App\Domain\Repository\MemberRepository;
use Nette\Utils\FileSystem;
use PhpOffice\PhpSpreadsheet\Reader\Xls;

class MemberXlsImportService
{
    private MemberRepository $memberRepository;

    public function __construct(
        MemberRepository $memberRepository
    ) {
        $this->memberRepository = $memberRepository;
    }


    public function import(): void
    {
        $reader = new Xls();
        $reader->setReadDataOnly(true);
        $xls = $reader->load(FileSystem::normalizePath(__DIR__ . '/../../../files/seznam-clenu.xls'));
        $sheet = $xls->getActiveSheet();

        foreach ($sheet->getRowIterator() as $row){
            if ($row->getRowIndex() === 1){
                continue;
            }
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            $member = new MemberEntity();
            $found = false;
            foreach ($cellIterator as $cell){
                if ($found === true){
                    break;
                }
                switch ($cell->getColumn()){
                    case 'A':
                        if ($this->memberRepository->findByFacrId((int)$cell->getValue()) !== null){
                            $found = true;
                            break;
                        }
                        $member->setFacrId($cell->getValue());
                        break;
                    case 'C':
                        $member->setFirstName($cell->getValue());
                        break;
                    case 'B':
                        $member->setLastName($cell->getValue());
                        break;
                    case 'D':
                        $member->setYearOfBirth((int)$cell->getValue());
                }
            }
            if ($found === false) {
                $member->setCreatedAt(new \DateTime());
                $member->setCreatedBy('IS FACR import');
                $this->memberRepository->store($member);
            }
        }
    }

}