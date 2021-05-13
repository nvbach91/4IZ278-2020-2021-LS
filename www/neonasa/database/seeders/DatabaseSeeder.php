<?php

namespace Database\Seeders;

use App\Models\Galaxy;
use App\Models\SpaceStation;
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
        // \App\Models\User::factory(10)->create();

        // Create 10 galaxies
        Galaxy::factory()
            ->count(10)
            ->make()
            ->map(function (Galaxy $galaxy) {
                // Persist the galaxy in database
                $galaxy->save();

                // And for each galaxy generate 5 - 15 space stations
                SpaceStation::factory()
                    ->count(rand(5, 15))
                    ->make()
                    ->map(fn (SpaceStation $station) => $galaxy->spaceStations()->create([
                        'name' => $station->name,
                        'gps' => $station->gps,
                        'img' => $station->img
                    ]));
           });
    }
}
