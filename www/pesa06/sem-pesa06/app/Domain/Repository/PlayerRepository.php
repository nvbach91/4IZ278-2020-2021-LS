<?php
declare(strict_types=1);

namespace App\Domain\Repository;


use App\Domain\Entity\PlayerEntity;
use App\Domain\Entity\TeamEntity;
use Dibi\Fluent;
use Etyka\Repository\Repository;

class PlayerRepository extends Repository
{
    public function findById(int $id): ?PlayerEntity
    {
        return $this->where([PlayerEntity::ID => $id])->first();
    }

    public function findByTeamId(int $teamId): array
    {
        return $this->where([PlayerEntity::TEAM_ID => $teamId])->getAll();
    }

    public function findTeamByYear(int $year): ?TeamEntity
    {
        $today = new \DateTime();
        $todayYear = $today->format('Y');
        $age = $todayYear - $year;
        $team = $this->connection->query('
        SELECT *
        FROM team
        WHERE team.age_under >= %i AND (team.age_under - 2) < %i
        ', $age, $age)->fetch();
        if ($team === false && $age >= 16) {
            $team = $this->connection->query('
            SELECT *
            FROM team
            WHERE team.age_under IS NULL
            ')->fetch();
        }
        return $team === false ? null : $this->createEntity($team, TeamEntity::class);
    }

    public function prepareCollection(): Fluent
    {
        return $this->connection->select('
        p.id, p.is_active, t.id AS team_id, t.name AS team_name, m.id AS member_id, m.first_name AS first_name,
         m.last_name AS last_name, m.facr_id AS facr_id, m.year_of_birth AS year_of_birth
        ')
            ->from('player p')
            ->leftJoin('team t ON t.id = p.team_id')
            ->leftJoin('member m ON m.id = p.member_id');
    }

    public function findPlayerByMemberId(int $memberId): ?PlayerEntity
    {
        return $this->where([PlayerEntity::MEMBER_ID => $memberId])->first();
    }

    public function getActivePlayers(): array
    {
        return $this->where([PlayerEntity::IS_ACTIVE => true])->getAll();
    }

}