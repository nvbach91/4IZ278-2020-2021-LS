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
        $savedSongsController   = new SavedSongsController;

        $items = [];
        // array_push($items, ['button1' => $button1]);
        // array_push($items, ['button2' => $button2]);
        // array_push($items, $asideitems);




        if ($usersController->isLoggedIn()) {

            $user = DB::table('users')->find(session('user_id'));

            $button1 = ['label' => 'edit profile', 'href' => '/profile/edit'];
            $button2 = ['label' => 'logout', 'href' => '/logout'];

            if (strlen($user->name) != 0) {
                $username = $user->name;
            } else {
                
                $username = $user->email;
            }
            $asideItems = [
                'Search' => '/',
                'My Profile' => '/profile',
                'Saved Chords' => '/savedChords',
                'Created By Me' => '/createdByMe',
            ];
            $anonymous = false;
            
        } else {
            $asideItems = [
                'Search' => '/',
            ];
            $username = 'Not logged in';
            $button1 = ['label' => 'sign up', 'href' => '/signup'];
            $button2 = ['label' => 'sign in', 'href' => '/signin'];
            $anonymous = true;
        }


        $items['button1'] = $button1;
        $items['button2'] = $button2;
        $items['asideItems'] = $asideItems;
        $items['loggedUser'] = $username;
        $items['anonymous'] = $anonymous;

        return $items;
    }
}
