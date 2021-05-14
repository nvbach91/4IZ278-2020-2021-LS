<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        // \App\Models\User::factory(10)->create();
=======
        $this->call([GalaxySeeder::class, SpaceStationSeeder::class]);
>>>>>>> 30c810fa343191f4da02bdecfab49f43a3afa6c2
    }
}
