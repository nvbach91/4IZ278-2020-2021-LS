<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reservation::query()->create([
            "date_from" => Carbon::create(2021, 1, 1, 9, 0, 0),
            "date_to" => Carbon::create(2021, 1, 1, 10, 0, 0),
            'user_id' => 2,
            'service_id' => 1

        ]);
    }
}
