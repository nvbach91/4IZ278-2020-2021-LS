<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AsideItemsController extends Controller
{
   public function getAsideItems() {
    return [
        'My Profile' => '/profile',
        'Saved Chords' => '/savedChords',
        'Created By Me' => '/createdByMe',
    ]; 
   }
}
