<?php


namespace App\Dto;


use Illuminate\Support\Carbon;

class FromTo
{

    public Carbon $from;
    public Carbon $to;


    /**
     * FromTo constructor.
     * @param Carbon $from
     * @param Carbon $to
     */
    public function __construct(Carbon $from, Carbon $to)
    {
        $this->from = $from;
        $this->to = $to;
    }


    public function format(string $format): string{
        return $this->from->format($format)." - ". $this->to->format($format);
    }



}
