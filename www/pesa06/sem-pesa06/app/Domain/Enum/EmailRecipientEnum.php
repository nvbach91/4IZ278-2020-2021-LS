<?php
declare(strict_types=1);

namespace App\Domain\Enum;


class EmailRecipientEnum
{
    public const TEAM = 'TÝM';
    public const COACHES = 'TRENÉŘI';
    public const EXECUTIVES = 'VEDENÍ';
    public const GLOBAL = 'VŠICHNI';
    public const ACTIVE_PLAYERS = 'AKTIVNÍ HRÁČI';

    public static function getValues(): array
    {
        return [
            self::TEAM,
            self::COACHES,
            self::EXECUTIVES,
            self::GLOBAL,
            self::ACTIVE_PLAYERS,
        ];
    }


}