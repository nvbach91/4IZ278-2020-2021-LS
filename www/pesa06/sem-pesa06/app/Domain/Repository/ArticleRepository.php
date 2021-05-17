<?php
declare(strict_types=1);

namespace App\Domain\Repository;


use App\Domain\Entity\ArticleEntity;
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


}