<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthenticationController extends Controller
{
    public function login(): RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route("homepage");
        }

        return Socialite::driver("github")->redirect();
    }

    public function callback(): RedirectResponse
    {
        $response = Socialite::driver("github")->user();

        if ($response === null) {
            return redirect()->route("index");
        }

        $user = User::where(["github_id" => $response->getId()])->first();

        // Register the user if needed
        if ($user === null) {
            $user = new User([
                "name" => $response->getName() ?? $response->getEmail(),
                "email" => $response->getEmail(),
                "github_id" => $response->getId()
            ]);

            $user->save();
        }

        Auth::login($user);

        return redirect()->route("dashboard");
    }

    public function logout(): RedirectResponse {
        Auth::logout();
        return redirect()->route("index");
    }
}
