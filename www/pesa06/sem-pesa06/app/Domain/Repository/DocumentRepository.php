<?php
declare(strict_types=1);

namespace Domain\Repository;


use Dibi\Fluent;
use Etyka\Repository\Repository;

class DocumentRepository extends Repository
{
    public function gridCollection(): Fluent
    {
        return $this->connection->select('d.*, CONCAT(m.first_name, " ", m.last_name) AS recipient')
            ->from('document d')
            ->leftJoin('member m ON d.member_id = m.id');
    }
}