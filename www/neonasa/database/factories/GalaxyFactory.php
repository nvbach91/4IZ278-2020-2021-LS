<?php

namespace Database\Factories;

use App\Models\Galaxy;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class GalaxyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Galaxy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // curl https://images-api.nasa.gov/search?q=galaxy | jq ".collection.items[].links[].href" | head -n 10
        $images = collect([
            "https://images-assets.nasa.gov/image/PIA04921/PIA04921~thumb.jpg",
            "https://images-assets.nasa.gov/image/PIA04634/PIA04634~thumb.jpg",
            "https://images-assets.nasa.gov/image/PIA07906/PIA07906~thumb.jpg",
            "https://images-assets.nasa.gov/image/PIA04623/PIA04623~thumb.jpg",
            "https://images-assets.nasa.gov/image/PIA04635/PIA04635~thumb.jpg",
            "https://images-assets.nasa.gov/image/PIA04633/PIA04633~thumb.jpg",
            "https://images-assets.nasa.gov/image/PIA15656/PIA15656~thumb.jpg",
            "https://images-assets.nasa.gov/image/PIA04629/PIA04629~thumb.jpg",
            "https://images-assets.nasa.gov/image/PIA08646/PIA08646~thumb.jpg",
            "https://images-assets.nasa.gov/image/PIA04624/PIA04624~thumb.jpg",
        ]);

        // curl https://images-api.nasa.gov/search?q=galaxy | jq ".collection.items[].data[].title" | head -n 10
        $names = collect([
            "Andromeda Galaxy",
            "Galaxy NGC5474",
            "Virgo Galaxy Cluster",
            "Galaxy UGC10445",
            "Galaxy NGC5962",
            "Galaxy NGC5398",
            "Portrait of a Galaxy Life",
            "Galaxy Messier 83",
            "Triple Scoop from Galaxy Hunter",
            "Galaxy Centaurus A",
            "Frankenstein Galaxy"
        ]);


        return [
            'name' => $names->random(),
            'img' => $images->random(),
            'size' => rand(100, 1000),
        ];
    }
}
