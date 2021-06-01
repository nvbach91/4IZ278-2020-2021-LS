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
        $urlPrefix = $this->getUrlPrefix();

        $items = [];

        if ($usersController->isLoggedIn()) {

            $user = DB::table('users')->find(session('user_id'));

            $button1 = ['label' => 'edit profile', 'href' => $urlPrefix . '/profile/edit'];
            $button2 = ['label' => 'logout', 'href' => $urlPrefix . 'logout'];

            if (strlen($user->name) != 0) {
                $username = $user->name;
            } else {

                $username = $user->email;
            }
            $asideItems = [
                'Search'        => $urlPrefix . '/',
                'My Profile'    => $urlPrefix . '/profile',
                'Saved Chords'  => $urlPrefix . '/savedChords',
                'Created By Me' => $urlPrefix . '/createdByMe',
            ];
            $anonymous = false;

            if(!$usersController->hasConfirmedEmail(session('user_id'))) {
               $asideItems['Confirm E–mail'] = $urlPrefix . '/email-confirmation';
            }
        } else {
            $asideItems = [
                'Search' => $urlPrefix . '/',
            ];
            $username = 'Not logged in';
            $button1 = ['label' => 'sign up', 'href' => $urlPrefix . '/signup'];
            $button2 = ['label' => 'sign in', 'href' => $urlPrefix . '/signin'];
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

    public function getUrlPrefix() {
        // return "/~klep03/public";
        return null;
    }
}
