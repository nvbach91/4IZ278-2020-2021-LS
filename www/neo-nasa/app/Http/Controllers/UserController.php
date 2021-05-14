<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller {
    public function fetchAll() {
        $results = User::all();
        return $results;
    }
    public function fetchById($id) {

    }
    public function fetchAllByGalaxyId($id) {
        
    }
}
