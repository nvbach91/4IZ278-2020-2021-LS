<?php

namespace App\Http\Controllers;

use App\Models\SpaceStation;
use App\Models\User;

class SpaceStationController extends Controller
{

    public function fetchAll() {
        return SpaceStation::all();
    }

    public function fetchById($id) {
        return SpaceStation::query()->where("id", $id)->get();
    }

    public function fetchAllSpacestationsByGalaxyId($galaxyId) {
        return SpaceStation::query()->where("galaxy_id", $galaxyId)->orderBy('name')->get();
    }

}
