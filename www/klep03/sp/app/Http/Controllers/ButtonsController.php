<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ButtonsController extends Controller
{
    public function getButtons() {
        return [
            'button1' => 'Sign Up',
            'button2' => 'Sign In',
        ];
    }

}
