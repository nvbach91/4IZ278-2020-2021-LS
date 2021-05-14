<?php

namespace App\Http\Controllers;

use App\Models\Galaxy;
use App\Models\User;

class GalaxyController extends Controller
{

    public function fetchAll() {
        return Galaxy::all();
    }

    public function fetchById($id) {
        return Galaxy::query()->where("id", $id)->get();
    }

}

