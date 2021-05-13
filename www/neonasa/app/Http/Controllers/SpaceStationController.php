<?php

namespace App\Http\Controllers;

use App\Models\Galaxy;
use App\Models\SpaceStation;

class SpaceStationController extends Controller
{
    public function index()
    {
        return view()->make('space-stations.index', ['stations' => SpaceStation::all()]);
    }

    public function show(SpaceStation $station)
    {
        return view()->make('space-stations.show', [
            'station' => $station,
            'galaxy' => $station->galaxy
        ]);
    }
}