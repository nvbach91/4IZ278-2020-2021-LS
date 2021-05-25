<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PageItemsController extends Controller
{
    public function fetch()
    {
        $asideItemscontroller   = new AsideItemscontroller;
        $usersController        = new UsersController;

        $items = [];
        // array_push($items, ['button1' => $button1]);
        // array_push($items, ['button2' => $button2]);
        // array_push($items, $asideitems);




        if ($usersController->isLoggedIn()) {

            $user = DB::table('users')->find(session('user_id'));

            $button1 = ['label' => 'edit profile', 'href' => '/profile/edit'];
            $button2 = ['label' => 'logout', 'href' => '/logout'];


            $username = $user->email;

            $asideItems = [
                'My Profile' => '/profile',
                'Saved Chords' => '/savedChords',
                'Created By Me' => '/createdByMe',
            ];
        } else {
            $asideItems = [
                'Search' => '/',
            ];
            $username = 'Not logged in';
            $button1 = ['label' => 'sign up', 'href' => '/signup'];
            $button2 = ['label' => 'sign in', 'href' => '/signin'];
        }


        $items['button1'] = $button1;
        $items['button2'] = $button2;
        $items['asideItems'] = $asideItems;
        $items['loggedUser'] = $username;

        return $items;
    }
}
