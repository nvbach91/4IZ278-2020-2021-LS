<div class="mb-5 pr-5 w-1/3">
    <a href="{{ route("collections.flashcards.show", [$collection, $flashcard]) }}"
       class="pb-4 pt-8 px-10 h-48 w-full rounded-xl flex flex-col justify-between transition transform shadow-md
        translate-y-0 hover:-translate-y-2 hover:shadow-xl bg-gradient-to-br from-gray-700 to-gray-800">
        <div class="flex flex-row items-start justify-between">
            <div class="text-3xl font-bold text-gray-300 flex flex-col items-start">
                <h1>{{ $flashcard->title }}</h1>
                <h2 class="uppercase font-bold ml-1 mt-3 text-sm tracking-wide text-gray-400">{{ $collection->title }}</h2>
            </div>
            @if ($favoriteFlashcards()->pluck('id')->contains($flashcard->id))
                <div data-favorite-action="remove" data-favorite-collection="{{ $collection->id }}" data-favorite-flashcard="{{ $flashcard->id }}"
                     class="favorite--flashcard block fas fa-star fa-2x text-yellow-500 hover:text-gray-600 transition"></div>
            @else
                <div data-favorite-action="add" data-favorite-collection="{{ $collection->id }}" data-favorite-flashcard="{{ $flashcard->id }}"
                     class="favorite--flashcard block fas fa-star fa-2x text-gray-600 hover:text-yellow-500 transition"></div>
            @endif
        </div>
        <div class="border-t border-gray-700 flex flex-row items-center justify-between pt-2 mt-5">
            <p class="font-bold text-sm tracking-wide text-gray-400">
                {{ $flashcard->created_at }}
            </p>
        </div>
    </a>
</div>
