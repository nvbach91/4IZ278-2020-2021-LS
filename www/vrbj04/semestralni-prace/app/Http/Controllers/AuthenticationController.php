<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthenticationController extends Controller
{
    public function login(): RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route("homepage");
        }

        return Socialite::driver("azure")->redirect();
    }

    public function callback(): RedirectResponse
    {
        $response = Socialite::driver("azure")->user();

        if ($response === null) {
            return redirect()->route("index");
        }

        $user = User::where(["azure_id" => $response->getId()])->first();

        // Register the user if needed
        if ($user === null) {
            $user = new User([
                "name" => $response->getName(),
                "email" => $response->getEmail(),
                "azure_id" => $response->getId()
            ]);

            $user->save();
        }

        Auth::login($user);

        return redirect()->route("homepage");
    }

    public function logout(): RedirectResponse {
        Auth::logout();
        return redirect()->route("index");
    }
}
