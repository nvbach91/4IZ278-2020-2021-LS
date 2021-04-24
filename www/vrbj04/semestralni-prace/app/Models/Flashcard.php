<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Flashcard extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description"
    ];

    public function collection(): BelongsTo
    {
        return $this->belongsTo(FlashcardCollection::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(FlashcardQuestion::class);
    }

    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, "favorite_flashcards");
    }
}
