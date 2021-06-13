<?php
declare(strict_types=1);

namespace App\Domain\Enum;


class DocumentTypeEnum
{
    public const PRISPEVKY = 'PRISPEVKY';
    public const FAKTURA = 'FAKTURA';
    public const PRIJATA_FAKTURA = 'PRIJATA_FAKTURA';

    public static function getValues(): array
    {
        return [
            self::PRISPEVKY => self::PRISPEVKY,
            self::FAKTURA => self::FAKTURA,
            self::PRIJATA_FAKTURA => self::PRIJATA_FAKTURA,
        ];
    }
}