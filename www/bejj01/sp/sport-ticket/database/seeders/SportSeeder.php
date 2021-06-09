<?php

namespace Database\Seeders;

use App\Models\Sport;
use Illuminate\Database\Seeder;

class SportSeeder extends Seeder {
    public function run() {
        Sport::truncate();

        Sport::create([
            'sport_name' => 'football',
            'img' => 'https://images.unsplash.com/photo-1543351611-58f69d7c1781?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mzl8fHNvY2NlcnxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
        ]);
        Sport::create([
            'sport_name' => 'hockey',
            'img' => 'https://images.unsplash.com/photo-1580748163848-a44d57d80804?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTR8fGhvY2tleXxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
        ]);
        Sport::create([
            'sport_name' => 'motorsport',
            'img' => 'https://images.unsplash.com/photo-1618652281404-d348284b7493?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Njd8fG1vdG9yc3BvcnR8ZW58MHx8MHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
        ]);
        Sport::create([
            'sport_name' => 'basketball',
            'img' => 'https://images.unsplash.com/photo-1580692475446-c2fabbbbf835?ixid=MnwxMjA3fDB8MHxzZWFyY2h8OXx8YmFza2V0YmFsbHxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
        ]);
        Sport::create([
            'sport_name' => 'tennis',
            'img' => 'https://images.unsplash.com/photo-1544298621-a28c00544483?ixid=MnwxMjA3fDB8MHxzZWFyY2h8OHx8dGVubmlzfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
        ]);
        Sport::create([
            'sport_name' => 'athletics',
            'img' => 'https://images.unsplash.com/photo-1526676317768-d9b14f15615a?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NXx8YXRobGV0aWNzfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
        ]);
    }
}
