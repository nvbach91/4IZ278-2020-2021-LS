<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditServiceRequest;
use App\Http\Requests\ServiceCreate;
use App\Http\Requests\ServiceDeleteRequest;
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

        $openingHours = [];
        foreach (range(0, 6) as $day) {
            $from = $request->get("from-" . $day);
            $to = $request->get("to-" . $day);
            if(!(isset($from) && isset($to))){
                continue;
            }

            $from = Carbon::now()->setSeconds(0)->setHour(explode(':', $from)[0])->setMinute(explode(':', $from)[1]);
            $to = Carbon::now()->setSeconds(0)->setHour(explode(':', $to)[0])->setMinute(explode(':', $to)[1]);
            if($from->isBefore($to) && $to->diffInMinutes($from)>=$request->get('duration')){
               array_push($openingHours, ['time_from'=>$from, 'time_to'=>$to, 'day'=>$day]);
            }
            else{
                continue;
            }
        }

        $this->serviceService->saveNewService($request->name, $request->description, $request->duration, $openingHours);
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
        $timeList = $this->reservationService->getListOfAllReservationsWithOccupation($id, Carbon::createFromTimestamp($timestamp, date_default_timezone_get()));
        return response()->json(['availableTimes' => $timeList]);

    }

    public function makeReservation(ServiceReserveRequest $request)
    {

        $userId = Auth::id();
        $serviceId = $request->get('serviceId');
        $dateTime = Carbon::parse($request->get('timeListSelection'))->setTimezone('Europe/Prague');
        $this->reservationService->makeReservation($userId, $serviceId, $dateTime);
        return redirect(route('home'));
    }

    public function delete(ServiceDeleteRequest $request)
    {
        $id = $request->get('serviceId');
        $this->serviceService->deleteService($id);
        return redirect()->route('service.index');
    }


    public function edit( int $id, EditServiceRequest $request)
    {
        $name = $request->get('name');
        $description = $request->get('description');
        $duration = $request->get('duration');

        $openingHours = [];
        foreach (range(0, 6) as $day) {
            $from = $request->get('from-' . $day);
            $to = $request->get('to-' . $day);
            if (!(isset($from) && isset($to))) {
                continue;
            }

            $from = Carbon::now()->setSeconds(0)->setHour(explode(':', $from)[0])->setMinute(explode(':', $from)[1]);
            $to = Carbon::now()->setSeconds(0)->setHour(explode(':', $to)[0])->setMinute(explode(':', $to)[1]);
            if ($from->isBefore($to) && $to->diffInMinutes($from) >= $request->get('duration')) {
                array_push($openingHours, ['time_from' => $from, 'time_to' => $to, 'day' => $day]);
            } else {
                continue;
            }
        }
        try{
            $this->serviceService->updateService($id, $name, $description, $duration, $openingHours);
        } catch (\Exception $exception){

        }

        return redirect()->route('service.index');
    }

    public function editView(int $id)
    {
        $service=        $this->serviceService->getById($id);
        $openingHours = [];
        foreach (range(0, 6) as $day) {
            $openingHours['day-' . $day] = null;
        }
        foreach ( $service->openingHours()->get() as $openingHour){
          $openingHours["day-".$openingHour->day] = $openingHour;
        }

        return view('service.service-edit', ['service' => $service, 'openingHours' =>$openingHours]);
    }
}
