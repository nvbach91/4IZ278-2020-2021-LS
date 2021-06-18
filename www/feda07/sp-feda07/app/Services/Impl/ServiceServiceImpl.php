<?php


namespace App\Services\Impl;


use App\Dto\FromTo;
use App\Dto\OpeningHoursDto;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\User;
use App\Services\IServiceService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class ServiceServiceImpl implements IServiceService
{


    public function searchService(?string $query = ""): LengthAwarePaginator
    {
        return Service::query()
            ->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
                $q->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->paginate(2);
//            ->withCount('openingHours')->having('opening_hours_count', '>', 0)
//            ->paginate(5);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getListOfServicesOfLoginUser(): LengthAwarePaginator
    {
        return User::query()->find(Auth::id())->services()->paginate(5);
    }

    /**
     * @param string $name
     * @param string $description
     * @param int $duration
     * @param array $openingHours
     * @return mixed
     */
    public function saveNewService(string $name, string $description, int $duration, array $openingHours): void
    {
        $newService = new Service;
        $newService->name = $name;
        $newService->duration = $duration;
        $newService->description = $description;
        $newService->user_id = Auth::id();
        $newService->save();
        foreach ($openingHours as $openingHour) {
            $newService->openingHours()->create([
                'time_from' => $openingHour['time_from'],
                'time_to' => $openingHour['time_to'],
                'day' => $openingHour['day'],
            ]);
        }
    }

    public function getById(int $id): Service
    {
        return Service::query()->findOrFail($id);
    }


    /**
     * @param int $id
     * @return OpeningHoursDto[]
     */
    public function getOpeningHours(int $id): array
    {
        $service = $this->getById($id);
        $openingHours = $service->openingHours;
        $ret = [];
        $days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday",];
        for ($i = 0; $i < 7; $i++) {
            $day = new OpeningHoursDto;
            $day->name = $days[$i];
            $day->openingHours = [];
            array_push($ret, $day);
        }

        foreach ($openingHours as $openingHour) {
            $fromTo = new FromTo($openingHour->time_from, $openingHour->time_to);
            array_push($ret[$openingHour->day]->openingHours, $fromTo);
        }
        return $ret;
    }

    public function deleteService(int $id): void
    {
        $service = Service::query()->find($id);
        $reservation = $service->reservations();
        $openingHours = $service->openingHours();
        if (isset($reservation)) {
            $reservation->delete();
        }
        if (isset($openingHours)) {
            $openingHours->delete();
        }
        $service->delete();

    }

    public function updateService(int $id, string $name, string $description, int $duration, array $openingHours): Service
    {
        $service = Service::query()->find($id);
        if (isset($name))
            $service->name = $name;
        if (isset($description))
            $service->description = $description;
        if (isset($duration))
            $service->duration = $duration;
        $openingHoursOld = $service->openingHours();
        try {
            $reservationCount = Reservation::query()->where('service_id', '=', $id)->count();
            if ($reservationCount == 0) {
                if (isset($openingHoursOld)) {
                    $openingHoursOld->delete();
                    foreach ($openingHours as $openingHour) {
                        $service->openingHours()->create([
                            'time_from' => $openingHour['time_from'],
                            'time_to' => $openingHour['time_to'],
                            'day' => $openingHour['day'],
                        ]);
                    }
                }
            } else {
                throw new \Exception('You can not change opening hours, because someone reserved this service in this time');
            }
        } finally {
            $service->save();
        }

        return $service;
    }
}
