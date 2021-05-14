<?php

namespace Database\Seeders;

use App\Models\Galaxy;
use Illuminate\Database\Seeder;

class GalaxySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Galaxy::query()->create([
            'name' =>'Milky Way',
            'size' =>52850,
            'img' => 'https://www.universetoday.com/wp-content/uploads/2013/10/milky_way.jpg'
        ]);
        Galaxy::query()->create([
            'name' =>'Andromeda',
            'size' =>110000,
            'img' => 'https://upload.wikimedia.org/wikipedia/commons/9/98/Andromeda_Galaxy_%28with_h-alpha%29.jpg'
        ]);
        Galaxy::query()->create([
            'name' =>'Pinwheel Galaxy',
            'size' =>85000,
            'img' => 'https://spaceplace.nasa.gov/pinwheel-galaxy/en/m101pic2.jpg'
        ]);
    }
}
