<?php

namespace App\View\Components;

use App\Models\Flashcard as Model;
use Illuminate\View\Component;

class Flashcard extends Component
{
    public \App\Models\FlashcardCollection  $collection;

    public Model $flashcard;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Model $flashcard, \App\Models\FlashcardCollection $collection)
    {
        $this->flashcard = $flashcard;
        $this->collection = $collection;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.flashcard');
    }
}
