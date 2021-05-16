<?php

namespace App\Http\Controllers;

use App\Models\Liquor;
use Illuminate\Http\Request;

class LiquorController extends Controller
{
    public function index() {
        return view('liquor.index');
    }

    public function show(Liquor $liquor) {

        return view('liquor.show', compact('liquor'));
    }
}
