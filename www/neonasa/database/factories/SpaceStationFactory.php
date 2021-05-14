<?php

namespace Database\Factories;

use App\Models\SpaceStation;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpaceStationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SpaceStation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // https://esahubble.org/images/archive/category/spacecraft/
        $images = collect([
            "https://cdn.spacetelescope.org/archives/images/thumb300y/s109e5706.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/hubble_flyby.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/hubble_earth_sp01.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/sts103_726_081.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/ann0814.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/s109e5101.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/hubble_space.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/sts103_731_051.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/s103e5459.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/sts103_731_017.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/s103e5209.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/s82e5084.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/s82e5718.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/s82e5652.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/s82e5429.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/s82e5422.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/s82e5419.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/s82e5407.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/s82e5278.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/s82e5242.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/s82e5175.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/s82e5937.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/hubble_in_orbit1.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/s109e5875.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/s103e5204.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/sa1.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/sts103_501_026.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/hst_service_mission_2d_hi.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/sts103_701_047.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/s103e5030.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/s103e5206.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/s103e5308.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/hubble_earth.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/s103e5345.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/s103e5454.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/s109e5705.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/sts103_701_009.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/s103e5031.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/heic0908c.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/heic1719f.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/opo0524a.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/solarpanels_remove.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/ACS_unpack.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/hst_arrays_hi.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/hst_grapple.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/hubble_release.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/nicmoscooler_install.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/solarpanels_insert.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/solarpanels_unfold.jpg",
            "https://cdn.spacetelescope.org/archives/images/thumb300y/sa2.jpg"
        ]);


        return [
            'name' => "Space station #" . $this->faker->randomNumber(5),
            'gps' => sprintf(
                "%s, %s, %s",
                $this->faker->randomFloat(20),
                $this->faker->randomFloat(20),
                $this->faker->randomFloat(20)
            ),
            'img' => $images->random()
        ];
    }
}
