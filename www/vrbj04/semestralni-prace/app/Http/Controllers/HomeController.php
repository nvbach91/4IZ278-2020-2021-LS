<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route("homepage");
        }

        return response()->view("index");
    }

    public function homepage(): Response
    {
        return response()->view("home");
    }
}
