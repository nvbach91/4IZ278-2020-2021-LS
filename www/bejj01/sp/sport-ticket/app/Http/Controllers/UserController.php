<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * Class UserController - Handles actions regarding user
 * @package App\Http\Controllers
 */
class UserController extends Controller {
    /**
     * Shows profile page with user data
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show() {
        if (!auth()->check()) {
            return redirect()->route('/home');
        }

        $user = User::find(auth()->id());
        $userTickets = $user->tickets;
        $activeTickets = [];
        $historyTickets = [];
        foreach ($userTickets as $ticket) {
            $ticket->event->start_date >= Carbon::today() ? array_push($activeTickets, $ticket) : array_push($historyTickets, $ticket);
        }

        return view('pages.profile', ['user' => $user, 'activeTickets' => $activeTickets, 'historyTickets' => $historyTickets]);
    }

    public function changePassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'curr_pass' => 'required',
            'new_pass' => 'required|string|min:8|confirmed',
            'new_pass_confirmation' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $current = $request->post('curr_pass');
        $new = $request->post('new_pass');

        if (!auth()->validate(['email' => auth()->user()->email, 'password' => $current])) {
            return redirect()->back()->with('error', 'You entered wrong password! Try it again.')->withInput();
        }

        try {
            $user = User::find(auth()->user()->user_id);
            $user->update(['password' => Hash::make($new)]);
            $user->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'The update has failed! Try it again.')->withInput();
        }

        return redirect()->back()->with('success', 'Password was successfully updated')->withInput();
    }

    public function changeUsername(Request $request) {
        $validator = Validator::make($request->all(), [
            'uname_pass' => 'required',
            'username' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $password = $request->post('uname_pass');
        $new = $request->post('username');

        if (!auth()->validate(['email' => auth()->user()->email, 'password' => $password])) {
            return redirect()->back()->with('error', 'You entered wrong password! Try it again.')->withInput();
        }

        try {
            $user = User::find(auth()->id());
            $user->update(['username' => $new]);
            $user->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'The update has failed! Try it again.')->withInput();
        }

        return redirect()->back()->with('success', 'Username was successfully updated')->withInput();
    }

    public function changeEmail(Request $request) {
        $validator = Validator::make($request->all(), [
            'email_pass' => 'required',
            'username' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $password = $request->post('email_pass');
        $new = $request->post('email');

        if (!auth()->validate(['email' => auth()->user()->email, 'password' => $password])) {
            return redirect()->back()->with('error', 'You entered wrong password! Try it again.')->withInput();
        }

        try {
            $user = User::find(auth()->id());
            $user->update(['email' => $new]);
            $user->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'The update has failed! Try it again.')->withInput();
        }

        return redirect()->back()->with('success', 'Username was successfully updated')->withInput();
    }
}
