<?php
declare(strict_types=1);

namespace Domain\Repository;


use Domain\Entity\StaffEntity;
use Dibi\Fluent;
use Etyka\Repository\Repository;

class StaffRepository extends Repository
{

    public function prepareStaffGridCollection(): Fluent
    {
        return $this->collection();
    }

    public function findByTeamId(int $teamId): array
    {
        return $this->createEntities($this->connection->query('
        SELECT s.*
        FROM staff s
        INNER JOIN staff_position_team spt on s.id = spt.staff_id
        WHERE spt.team_id = %i
        ', $teamId)->fetchAll(), StaffEntity::class);
    }

    public function prepareSelect(): array
    {
        return $this->connection->query('SELECT id, CONCAT(first_name, " ", last_name) AS name
        FROM staff')->fetchPairs('id', 'name');
    }

}