<?php
declare(strict_types=1);

namespace Domain\Repository;


use Dibi\Fluent;
use Domain\Entity\StaffPositionTeamEntity;
use Etyka\Repository\Repository;

class StaffPositionTeamRepository extends Repository
{
    public function gridCollection(?string $staffId): Fluent
    {
        $res = $this->connection->select('spt.id AS id, p.name AS position, p.id AS positionId, t.id AS teamId, t.name AS teamName')
            ->from('staff_position_team spt')
            ->leftJoin('position p ON spt.position_id = p.id')
            ->leftJoin('team t ON spt.team_id = t.id');
        if ($staffId === null) {
            return $res;
        }
        return $res->where('spt.staff_id = %i', (int)$staffId);
    }

    public function findPositionNamesByStaffIdAndTeamId(int $staffId, int $teamId): array
    {
        return $this->connection->query('
        SELECT p.name
        FROM staff_position_team spt
        LEFT JOIN position p on spt.position_id = p.id
        WHERE spt.team_id = %i AND spt.staff_id = %i
        ', $teamId, $staffId)->fetchAll();
    }
}