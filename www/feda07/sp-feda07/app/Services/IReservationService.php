<?php


namespace App\Services;


use App\Models\Reservation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

interface IReservationService
{
    /**
     * @return Reservation[]|Collection
     */
    public function getReservationOfLoginUser(): array|Collection;

    /**
     * @param int $serviceId
     * @param Carbon $date
     * @return array
     */
    public function getListOfAllReservationsWithOccupation(int $serviceId, Carbon $date): array;

    /**
     * @param int $n
     * @return Carbon[]
     */
    public function getListOfNextNDays(int $n): array;

    /**
     * @param int $userId
     * @param int $serviceId
     * @param Carbon $dateTime
     * @return Reservation
     */
    public function makeReservation(int $userId, int $serviceId, Carbon $dateTime): Reservation;

    /**
     * @param int $id
     * @return void
     */
    public function deleteReservation(int $id): void;

}
