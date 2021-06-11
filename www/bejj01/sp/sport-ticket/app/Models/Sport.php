<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Sport - Sport table
 * @package App\Models
 */
class Sport extends Model
{
    use HasFactory;

    protected $table = 'sport';
    protected $primaryKey = 'sport_id';

    protected $fillable = [
        'sport_name',
        'img'
    ];

    /**
     * Returns collection of events for specific sport
     * @return HasMany
     */
    public function events(): HasMany {
        return $this->hasMany(Event::class, 'sport_id', 'sport_id');
    }

    /**
     * Returns collection of users that has specific sport as favorite
     * @return BelongsToMany
     */
    public function favoritedBy(): BelongsToMany {
        return $this->belongsToMany(User::class, 'favorite_sport');
    }
}
