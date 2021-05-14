<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Galaxy extends Model
{
    protected $table='galaxies';
    protected $primaryKey='id';

    /**
     * @return HasMany
     */
    public function spaceStations(): HasMany
    {
        return $this->hasMany(SpaceStation::class);
    }

}
