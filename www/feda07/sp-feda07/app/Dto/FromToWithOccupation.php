<?php


namespace App\Dto;


use Illuminate\Support\Carbon;

class FromToWithOccupation extends FromTo
{

    public $isOccupated = false;

    /**
     * FromToWithOccupation constructor.
     * @param Carbon $from
     * @param Carbon $to
     * @param bool $isOccupated
     */
    public function __construct(Carbon $from, Carbon $to, bool $isOccupated = false)
    {
        parent::__construct($from, $to);
        $this->isOccupated = $isOccupated;
    }


}
