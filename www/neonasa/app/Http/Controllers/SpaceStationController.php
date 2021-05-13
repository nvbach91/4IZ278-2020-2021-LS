<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpaceStation;

class SpaceStationController extends Controller
{
    public function fetchByGalaxyId($id)
    {
        return SpaceStation::where("galaxy_id", $id)->get();
    }

    public function fetchAll()
    {
        return SpaceStation::all();
    }
}