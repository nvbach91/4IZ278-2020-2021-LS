<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceCreate;
use App\Services\IServiceService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ServiceController extends Controller
{

    /**
     * ServiceController constructor.
     * @param IServiceService $serviceService
     */
    public function __construct(private IServiceService $serviceService)
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

//        $availableTermins= $this->serviceService->getAvailableTermins($id);
        return view('service.info', ['service' => $service, "openingHours" => $openingHours]);
    }
}
