<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property-read Collection $collections
 * @method static Builder where(array $array)
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'azure_id',
    ];

    public function collections(): HasMany
    {
        return $this->hasMany(FlashcardCollection::class);
    }

    public function favoriteCollections(): BelongsToMany
    {
        return $this->belongsToMany(FlashcardCollection::class, "favorite_collections");
    }

    public function favoriteFlashcards(): BelongsToMany
    {
        return $this->belongsToMany(Flashcard::class, "favorite_flashcards");
    }
}
