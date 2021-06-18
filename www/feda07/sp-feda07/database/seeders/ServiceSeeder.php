<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::query()->find(1);
        $user->services()->create([
            'name' => 'auto-service',
            'description' => 'help to your car',
            'duration' => 60

        ]);
        $user->services()->create([
            'name' => 'auto-service-1',
            'description' => 'help to your car',
            'duration' => 60

        ]);

        $user->services()->create([
            'name' => 'auto-service-2',
            'description' => 'help to your car',
            'duration' => 60

        ]);
    }
}
