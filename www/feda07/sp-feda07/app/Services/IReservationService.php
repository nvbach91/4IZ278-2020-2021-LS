<?php


namespace App\Services;


use App\Models\Reservation;
use Illuminate\Database\Eloquent\Collection;

interface IReservationService
{
    /**
     * @return Reservation[]|Collection
     */
    public function getReservationOfLoginUser(): array|Collection;
}
