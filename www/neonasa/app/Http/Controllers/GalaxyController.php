<?php

namespace App\Http\Controllers;

use App\Models\Galaxy;

class GalaxyController extends Controller
{
    public function index()
    {
        return view()->make("galaxies.index", ["galaxies" => Galaxy::all()]);
    }

    public function show(Galaxy $galaxy)
    {
        return view()->make("galaxies.show", ["galaxy" => $galaxy]);
    }
}