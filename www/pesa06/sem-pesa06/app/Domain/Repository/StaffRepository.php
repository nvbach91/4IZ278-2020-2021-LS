<?php
declare(strict_types=1);

namespace App\Domain\Repository;


use App\Domain\Entity\StaffEntity;
use Dibi\Fluent;
use Etyka\Repository\Repository;

class StaffRepository extends Repository
{

    public function prepareStaffGridCollection(): Fluent
    {
        return $this->connection->select('s.*, t.name AS team_name')
            ->from('staff s')
            ->leftJoin('team t')
            ->on('s.team_id = t.id');
    }

    public function findByTeamId(int $teamId): array
    {
        return $this->where([StaffEntity::TEAM_ID => $teamId])->getAll();
    }

}