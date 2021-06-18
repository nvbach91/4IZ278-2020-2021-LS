<?php
declare(strict_types=1);

namespace Domain\Repository;


use Domain\Entity\MemberEntity;
use App\Domain\Enum\StaffTypeEnum;
use Etyka\Repository\Repository;

class MemberRepository extends Repository
{
    public function findById(int $memberId): ?MemberEntity
    {
        return $this->find($memberId);
    }

    public function store(?MemberEntity $entity): void
    {
        $this->persist($entity);
    }

    public function findByFacrId(int $facrId): ?MemberEntity
    {
        return $this->where([MemberEntity::FACR_ID => $facrId])->first();
    }

    public function suggest(string $firstName, string $lastName): array
    {
        $result = $this->connection->query('
        SELECT m.id, m.facr_id, m.first_name, m.last_name
        FROM member m
        WHERE m.first_name LIKE %~like~ AND m.last_name LIKE %~like~
        ', $firstName, $lastName)->fetch();
        if ($result === false) {
            return [
                'error' => true
            ];
        }
        return [
            'memberId' => $result['id'],
            'facrId' => $result['facr_id'],
            'firstName' => $result['first_name'],
            'lastName' => $result['last_name']
        ];
    }

    public function getAllEmails(): array
    {
        return $this->connection->query('
        SELECT id, email
        FROM member
        WHERE email IS NOT NULL
        ')->fetchPairs('id', 'email');
    }

    public function getMailsByTeamId(int $teamId): array
    {
        return $this->connection->query('
        SELECT m.id, m.email
        FROM member m
        LEFT JOIN player p ON m.id = p.member_id
        WHERE p.team_id = %i AND m.email IS NOT NULL
        ', $teamId)->fetchPairs('id', 'email');
    }

    public function getActivePlayerMails(): array
    {
        return $this->connection->query('
        SELECT m.id, m.email
        FROM member m 
        LEFT JOIN player p ON m.id = p.member_id
        WHERE p.is_active = TRUE AND m.email IS NOT NULL
        ')->fetchPairs('id', 'email');
    }

    public function getStaffMails(): array
    {
        return $this->connection->query('
        SELECT m.id, m.email
        FROM staff s 
        LEFT JOIN member m on s.member_id = m.id
        WHERE m.email IS NOT NULL
        ')->fetchPairs('id', 'email');
    }

}