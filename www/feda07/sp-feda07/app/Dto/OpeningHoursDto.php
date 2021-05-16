<?php


namespace App\Dto;


use Illuminate\Support\Carbon;

class OpeningHoursDto
{
    /**
     * @var string Name of day
     */
    public string $name;
    /**
     * @var FromTo[]
     */
    public array $openingHours;
}
