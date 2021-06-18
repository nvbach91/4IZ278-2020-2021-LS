<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class OpeningHours extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service = Service::query()->find(1);
        $service->openingHours()->create([
            'time_from' => Carbon::create(2021,1,1,8,0,0)->toTimeString(),
            'time_to' => Carbon::create(2021,1,1,16,0,0)->toTimeString(),
            'day' => Carbon::MONDAY

        ]);

        $service->openingHours()->create([
            'time_from' => Carbon::create(2021,1,1,8,0,0)->toTimeString(),
            'time_to' => Carbon::create(2021,1,1,16,0,0)->toTimeString(),
            'day' => Carbon::TUESDAY

        ]);

        $service->openingHours()->create([
            'time_from' => Carbon::create(2021,1,1,8,0,0)->toTimeString(),
            'time_to' => Carbon::create(2021,1,1,16,0,0)->toTimeString(),
            'day' => Carbon::WEDNESDAY

        ]);

        $service->openingHours()->create([
            'time_from' => Carbon::create(2021,1,1,8,0,0)->toTimeString(),
            'time_to' => Carbon::create(2021,1,1,16,0,0)->toTimeString(),
            'day' => Carbon::THURSDAY

        ]);

        $service->openingHours()->create([
            'time_from' => Carbon::create(2021,1,1,8,0,0)->toTimeString(),
            'time_to' => Carbon::create(2021,1,1,16,0,0)->toTimeString(),
            'day' => Carbon::FRIDAY

        ]);

    }
}
