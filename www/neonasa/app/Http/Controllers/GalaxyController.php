<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galaxy;

class GalaxyController extends Controller
{
    public function fetchById($id)
    {
        return Galaxy::where("id", $id)->first();
    }

    public function fetchAll()
    {
        return Galaxy::all();
    }
}