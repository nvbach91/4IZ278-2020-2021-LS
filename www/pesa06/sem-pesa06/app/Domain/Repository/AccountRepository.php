<?php
declare(strict_types=1);

namespace Domain\Repository;


use App\Domain\Entity\AccountEntity;
use Etyka\Repository\Repository;

class AccountRepository extends Repository
{
    public function findByUsername(string $username): ?AccountEntity
    {
        return $this->where([AccountEntity::EMAIL => $username])->first();
    }
}