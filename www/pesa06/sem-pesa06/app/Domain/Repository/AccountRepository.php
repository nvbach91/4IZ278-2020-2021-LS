<?php
declare(strict_types=1);

namespace Domain\Repository;


use Dibi\Fluent;
use Domain\Entity\AccountEntity;
use Etyka\Repository\Repository;

class AccountRepository extends Repository
{
    public function findByUsername(string $username): ?AccountEntity
    {
        return $this->where([AccountEntity::EMAIL => $username])->first();
    }

    public function gridCollection(): Fluent
    {
        return $this->connection->select('a.*, s.first_name AS name, s.last_name AS lastname')
            ->from('account a')
            ->leftJoin('staff s ON s.id = a.staff_id');
    }
}