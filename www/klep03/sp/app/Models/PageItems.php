<?php

namespace App\Models;

use App\Http\Controllers\AsideItemsController;
use App\Http\Controllers\SavedSongsController;
use App\Http\Controllers\UsersController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PageItems extends Model
{
    use HasFactory;
    public function fetch()
    {
        $asideItemscontroller   = new AsideItemsController;
        $usersController        = new UsersController;
        $savedSongsController   = new SavedSongsController;
        $urlPrefix = null;
        // $urlPrefix = "/~klep03/public";
        

        $items = [];
        // array_push($items, ['button1' => $button1]);
        // array_push($items, ['button2' => $button2]);
        // array_push($items, $asideitems);




        if ($usersController->isLoggedIn()) {

            $user = DB::table('users')->find(session('user_id'));

            $button1 = ['label' => 'edit profile', 'href' => 'profile/edit'];
            $button2 = ['label' => 'logout', 'href' => 'logout'];

            if (strlen($user->name) != 0) {
                $username = $user->name;
            } else {

                $username = $user->email;
            }
            $asideItems = [
                'Search' => '.',
                'My Profile' => 'profile',
                'Saved Chords' => 'savedChords',
                'Created By Me' => 'createdByMe',
            ];
            $anonymous = false;

            if(!$usersController->hasConfirmedEmail(session('user_id'))) {
               $asideItems['Confirm E–mail'] = 'email-confirmation';
            }
        } else {
            $asideItems = [
                'Search' => '',
            ];
            $username = 'Not logged in';
            $button1 = ['label' => 'sign up', 'href' => 'signup'];
            $button2 = ['label' => 'sign in', 'href' => 'signin'];
            $anonymous = true;
        }


        $items['button1'] = $button1;
        $items['button2'] = $button2;
        $items['asideItems'] = $asideItems;
        $items['loggedUser'] = $username;
        $items['anonymous'] = $anonymous;
        $items['urlPrefix'] = $urlPrefix;

        return $items;
    }
}
