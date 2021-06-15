<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceCreate;
use App\Http\Requests\ServiceReserveRequest;
use App\Services\IReservationService;
use App\Services\IServiceService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{

    /**
     * ServiceController constructor.
     * @param IServiceService $serviceService
     * @param IReservationService $reservationService
     */
    public function __construct(private IServiceService $serviceService, private IReservationService $reservationService)
    {
        $this->middleware('auth');
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        return view('service.list', [
            'myServices' => $this->serviceService->getListOfServicesOfLoginUser(),
        ]);
    }

    public function create(): Factory|View|Application
    {
        return view('service.create');
    }

    public function createForm(ServiceCreate $request): RedirectResponse
    {
        $this->serviceService->saveNewService($request->name, $request->description, $request->duration);
        return redirect(route('service.index'));
    }

    public function info(int $id)
    {
        $service = $this->serviceService->getById($id);
        $openingHours = $this->serviceService->getOpeningHours($id);
        $daysList = $this->reservationService->getListOfNextNDays(21);
        $timeList = $this->reservationService->getListOfAllReservationsWithOccupation($id, Carbon::now());
        return view('service.info', ['service' => $service, "openingHours" => $openingHours, 'daysList' => $daysList, 'timeList' => $timeList]);
    }

    public function getAvailableDays(int $id, int $timestamp)
    {
//TODO:fix timestamp 
        $timeList = $this->reservationService->getListOfAllReservationsWithOccupation($id, Carbon::createFromTimestamp($timestamp,date_default_timezone_get()));
        return response()->json(['availableTimes' => $timeList]);

    }

    public function makeReservation(ServiceReserveRequest $request){

        $userId = Auth::id();
        $serviceId = $request->get('serviceId');
        $dateTime = Carbon::parse($request->get('timeListSelection'))->setTimezone('Europe/Prague');
        $this->reservationService->makeReservation($userId, $serviceId, $dateTime);
        return redirect(route('service.index'));
    }
}
