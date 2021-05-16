<?php


namespace App\Services\Impl;


use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class IReservationServiceImpl implements \App\Services\IReservationService
{

    /**
     * @return Reservation[]|Collection
     */
    public function getReservationOfLoginUser():array|Collection
    {
        return User::query()->find(Auth::user()->getAuthIdentifier())->reservations;
    }
}
