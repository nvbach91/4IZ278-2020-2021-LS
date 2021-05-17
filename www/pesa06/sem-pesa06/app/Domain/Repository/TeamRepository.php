<?php
declare(strict_types=1);

namespace App\Domain\Repository;


use App\Domain\Entity\TeamEntity;
use Etyka\Repository\Repository;

class TeamRepository extends Repository
{
    public function findById(int $id): ?TeamEntity
    {
        return $this->where([TeamEntity::ID => $id])->first();
    }

    public function store(TeamEntity $entity): void
    {
        $this->persist($entity);
    }

    public function prepareMenu(): array
    {
        $menu = $this->connection->query('
        SELECT id,name
        FROM team
        WHERE age_under IS NULL
        ')->fetchPairs('id', 'name');
        $teams = $this->connection->query('
        SELECT id, name
        FROM team
        WHERE age_under IS NOT NULL
        ORDER BY age_under DESC')->fetchPairs('id', 'name');
        $menu = $menu + $teams;
        return $menu;
    }

}