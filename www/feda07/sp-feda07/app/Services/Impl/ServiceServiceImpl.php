<?php


namespace App\Services\Impl;


use App\Dto\FromTo;
use App\Dto\OpeningHoursDto;
use App\Models\Service;
use App\Models\User;
use App\Services\IServiceService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ServiceServiceImpl implements IServiceService
{


    public function searchService(?string $query = ""): LengthAwarePaginator
    {
        return Service::query()
            ->where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->paginate(5);
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
     * @return mixed
     */
    public function saveNewService(string $name, string $description, int $duration): void
    {
        $newService = new Service;
        $newService->name = $name;
        $newService->duration = $duration;
        $newService->description = $description;
        $newService->user_id = Auth::id();
        $newService->save();
    }

    public function getById(int $id): Service
    {
        return Service::query()->findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function getAvailableTermins(int $id, ?Carbon $from = null): array
    {
        if ($from == null) {
            $from = Carbon::today();
        }
        $service = $this->getById($id);
        $openingHours = $service->openingHours;
        $reservation = $service->reservation;
        $availableTermins = [];
        for ($i = 0; $i < 7; $i++) {

        }
        return [];
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
        $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
        for ($i = 0; $i < 7; $i++) {
            $day = new OpeningHoursDto;
            $day->name = $days[$i];
            $day->openingHours = [];
            array_push($ret, $day);
        }

        foreach ($openingHours as $openingHour) {
            $fromTo = new FromTo();
            $fromTo->from = $openingHour->time_from;
            $fromTo->to = $openingHour->time_to;
            array_push($ret[$openingHour->day-1]->openingHours, $fromTo);
        }
        return $ret;
    }
}
