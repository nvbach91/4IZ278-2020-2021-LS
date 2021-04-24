<?php /** @noinspection PhpPropertyOnlyWrittenInspection */

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class FlashcardCollection extends Component
{
    public \App\Models\FlashcardCollection $collection;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(\App\Models\FlashcardCollection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.flashcard-collection');
    }
}
