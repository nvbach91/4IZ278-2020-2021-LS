<?php
declare(strict_types=1);

namespace App\Domain\Enum;


class StaffTypeEnum
{
    public const EXECUTIVE = 'VEDENI';
    public const COACH = 'TRENER';
    public const DETENTOR = 'SPRAVCE';
    public const TEAM_LEAD = 'VEDOUCI';

    public static function getValues(): array
    {
        return [
            self::EXECUTIVE,
            self::COACH,
            self::DETENTOR,
            self::TEAM_LEAD
        ];
    }


}