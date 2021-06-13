<?php
declare(strict_types=1);

namespace App\Domain\Enum;


class EmailRecipientEnum
{
    public const TEAM = 'TÝM';
    public const STAFF = 'ZAMĚSTNANCI';
    public const GLOBAL = 'VŠICHNI';
    public const ACTIVE_PLAYERS = 'AKTIVNÍ HRÁČI';

    public static function getValues(): array
    {
        return [
            self::TEAM,
            self::STAFF,
            self::GLOBAL,
            self::ACTIVE_PLAYERS,
        ];
    }


}