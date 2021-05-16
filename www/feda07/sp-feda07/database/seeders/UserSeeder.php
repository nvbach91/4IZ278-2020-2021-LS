<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::query()->create([
            'name' =>"Alexandra",
            'surname' =>"Fedina",
            'email' => 'feda07@gmail.com',
            'phone' => '+420987654321',
            'password' => Hash::make('password'),
        ]);
        User::query()->create([
            'name' =>"Victor",
            'surname' =>"Babu",
            'email' => 'vicbabu@gmail.com',
            'phone' => '+420999999999',
            'password' => Hash::make('1234'),
        ]);
    }
}
