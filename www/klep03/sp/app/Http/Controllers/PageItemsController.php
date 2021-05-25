<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PageItemsController extends Controller
{
    public function fetch()
    {
        $asideItemscontroller   = new AsideItemscontroller;
        $usersController        = new UsersController;

        $items = [];

        $button1 = ['label' => 'sign up', 'href' => '/signup'];
        $button2 = ['label' => 'sign in', 'href' => '/signin'];

        $asideItems = $asideItemscontroller->getasideitems();

        // array_push($items, ['button1' => $button1]);
        // array_push($items, ['button2' => $button2]);
        // array_push($items, $asideitems);

        


        if(session()->has('Loggeduser')) {
            $user = User::where('id', '=', session('LoggedUser'))->first();
            
            $button1 = ['label' => '', 'href' => ''];
            $button2 = ['label' => 'logout', 'href' => '/logout'];
        }

        $items['button1'] = $button1;
        $items['button2'] = $button2;
        $items['asideItems'] = $asideItems;
        $items['loggedUser'] = 'Peta';

        return $items;
    }
}


