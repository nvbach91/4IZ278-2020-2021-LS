<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class FlashcardCollection
 * @package App\Models
 *
 * @method static Builder public(?int $exceptUser = null)
 */
class FlashcardCollection extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "is_public"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function flashcards(): HasMany
    {
        return $this->hasMany(Flashcard::class, "collection_id", "id");
    }

    public function scopePublic(Builder $query, ?int $exceptUser = null): Builder
    {
        $query->where("is_public", "=", true);

        if ($exceptUser !== null) {
            $query->where("user_id", "!=", $exceptUser);
        }

        return $query;
    }

    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, "favorite_collections");
    }
}
