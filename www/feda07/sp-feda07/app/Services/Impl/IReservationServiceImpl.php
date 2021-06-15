<?php


namespace App\Services\Impl;


use App\Dto\FromToWithOccupation;
use App\Mail\ReservationComplited;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\User;
use App\Services\IReservationService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class IReservationServiceImpl implements IReservationService
{

    /**
     * @return Reservation[]|Collection
     */
    public function getReservationOfLoginUser(): array|Collection
    {
        return User::query()->find(Auth::user()->getAuthIdentifier())->reservations;
    }

    /**
     * @param int $serviceId
     * @param Carbon $date
     * @return FromToWithOccupation[]
     */
    public function getListOfAllReservationsWithOccupation(int $serviceId, Carbon $date): array
    {

        $service = Service::query()->find($serviceId);
        $dayOfWeek = $date->dayOfWeek;
        $openingHours = $service->openingHours->where('day', '=', $dayOfWeek)->all();
        $possibleTerms = [];
        $duration = $service->duration;

        foreach ($openingHours as $openingHour) {
            $possibleTimeFrom = $openingHour->time_from;
            $possibleTimeTo = $openingHour->time_to;
            while ($possibleTimeFrom->isBefore($possibleTimeTo)) {
                $timeFrom = $possibleTimeFrom;
                $timeTo = $possibleTimeFrom->copy()->add($duration, 'minutes');
                $isOccupant = $service->reservations->where('date_from', '=', $timeFrom)->count() != 0;
                array_push($possibleTerms, new FromToWithOccupation($timeFrom, $timeTo, $isOccupant));
                $possibleTimeFrom = $timeTo;
            }
        }


        return $possibleTerms;
    }

    public function getListOfNextNDays(int $n): array
    {
        $ret = [];
        for ($i = 0; $i < $n; $i++) {
            array_push($ret, Carbon::now()->addDays($i));
        }
        return $ret;
    }


    public function makeReservation(int $userId, int $serviceId, Carbon $dateTime): Reservation
    {
        $email = User::query()->find($userId)->email;
        $duration = Service::query()->find($serviceId)->duration;
        $timeFrom = $dateTime->copy();
        $timeTo = $timeFrom->copy()->addMinutes($duration);
        $reservation =  Reservation::query()->create([
            'date_from' => $timeFrom,
            'date_to' => $timeTo,
            'user_id' => $userId,
            'service_id' =>$serviceId
        ]);
        $mail = new ReservationComplited($reservation);
        //Mail::to($email)->send($mail);
        return  $reservation;

    }

    /**
     * @inheritDoc
     */
    public function deleteReservation(int $id): void
    {
        $reservation = Reservation::query()->find($id);
        if ($reservation->user->id != Auth::id()){
            return;
        }
        $reservation->delete();
    }
}
