<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller {
    public function show() {
        if (!auth()->check()) {
            return redirect('/');
        }

        $user = User::find(auth()->id());
        return view('pages.profile', ['user' => $user]);
    }
}
