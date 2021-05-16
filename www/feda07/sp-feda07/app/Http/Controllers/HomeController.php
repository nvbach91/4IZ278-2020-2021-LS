<?php

namespace App\Http\Controllers;

use App\Services\IServiceService;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var IServiceService
     */
    private IServiceService $serviceService;

    /**
     * Create a new controller instance.
     *
     * @param IServiceService $serviceService
     */
    public function __construct(IServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return Renderable
     */
    public function index(Request $request): Renderable
    {
        return view('home', [
            "services" => $this->serviceService->searchService($request->query('query',''))
        ]);
    }
}
