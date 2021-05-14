<?php

namespace Database\Seeders;

use App\Models\SpaceStation;
use Illuminate\Database\Seeder;

class SpaceStationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SpaceStation::query()->create([
            'name' =>'Mir',
            'gps' =>'527890:253748:976449',
            'img' =>'https://upload.wikimedia.org/wikipedia/commons/thumb/0/09/Mir_Space_Station_viewed_from_Endeavour_during_STS-89.jpg/480px-Mir_Space_Station_viewed_from_Endeavour_during_STS-89.jpg',
            'galaxy_id'=>1,
        ]);

        SpaceStation::query()->create([
            'name' =>'Tiangong-2',
            'gps' =>'908890:345748:011147',
            'img' =>'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4a/Model_of_the_Chinese_Tiangong_Shenzhou.jpg/300px-Model_of_the_Chinese_Tiangong_Shenzhou.jpg',
            'galaxy_id'=>1,
        ]);
        SpaceStation::query()->create([
            'name' =>'Genesis',
            'gps' =>'755342:9475639:364785',
            'img' =>'https://upload.wikimedia.org/wikipedia/en/3/37/Genesis_rendering.jpg',
            'galaxy_id'=>1,
        ]);
        SpaceStation::query()->create([
            'name' =>'BlaBlaBla',
            'gps' =>'189000000:358858589:23685357886',
            'img' =>'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9f/Space_Station_Freedom_design_1991.jpg/480px-Space_Station_Freedom_design_1991.jpg',
            'galaxy_id'=>2,
        ]);
        SpaceStation::query()->create([
            'name' =>'AndromedaStation',
            'gps' =>'1478989000:246809589:2368535345',
            'img' =>'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0f/MOL_USAF.png/480px-MOL_USAF.png',
            'galaxy_id'=>2,
        ]);
        SpaceStation::query()->create([
            'name' =>'PinwheelStation',
            'gps' =>'144667865439000:12388765409589:276543235778',
            'img' =>'https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/Columbus_MTFF_drawing.jpg/480px-Columbus_MTFF_drawing.jpg',
            'galaxy_id'=>3,
        ]);

    }
}
