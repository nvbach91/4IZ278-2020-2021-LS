<?php

namespace App\Http\Controllers;

use App\Models\Flashcard;
use App\Models\FlashcardCollection;

class FavoritesController extends Controller
{
    public function favoriteFlashcard(FlashcardCollection $collection, Flashcard $flashcard) {
        $this->authorize("view", $collection);
        $this->user()->favoriteFlashcards()->attach($flashcard->id);
    }

    public function favoriteCollection(FlashcardCollection $collection) {
        $this->authorize("view", $collection);
        $this->user()->favoriteCollections()->attach($collection->id);
    }

    public function unfavoriteFlashcard(FlashcardCollection $collection, Flashcard $flashcard) {
        $this->user()->favoriteFlashcards()->detach($flashcard->id);
    }

    public function unfavoriteCollection(FlashcardCollection $collection) {
        $this->user()->favoriteCollections()->detach($collection->id);
    }
}
