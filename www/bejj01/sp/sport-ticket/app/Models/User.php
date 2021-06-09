<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User - user table
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Holding collection of user tickets
     * @return HasMany
     */
    public function tickets(): HasMany {
        return $this->hasMany(Ticket::class, 'user_id', 'user_id');
    }

    /**
     * Collection of favorite sports
     * @return BelongsToMany
     */
    public function favoriteSports(): BelongsToMany {
        return $this->belongsToMany(Sport::class, 'favorite_sport', 'user_id', 'sport_id');
    }
}
