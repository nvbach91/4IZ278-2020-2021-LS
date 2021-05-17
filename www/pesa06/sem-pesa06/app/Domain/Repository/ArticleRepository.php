<?php
declare(strict_types=1);

namespace Domain\Repository;


use Domain\Entity\ArticleEntity;
use Etyka\Repository\Repository;

class ArticleRepository extends Repository
{
    public function findById(int $id): ?ArticleEntity
    {
        return $this->where([ArticleEntity::ID => $id])->first();
    }

    public function findByTeamId(int $teamId): array
    {
        return $this->where([ArticleEntity::TEAM_ID => $teamId])->getAll();
    }

    public function findPagedIds(int $page, int $limit = 10): array
    {
        return $this->connection->query('
        SELECT id
        FROM article
        ORDER BY created_at DESC
        LIMIT %i
        OFFSET %i
        ', $limit, ($page * $limit))->fetchAll();
    }


}