<div class="inline-block w-1/3 pr-4">
    <a href="{{ route("collections.show", $collection->id) }}"
       class="pb-4 pt-8 px-10 w-full rounded-lg flex flex-col transition transform shadow-md translate-y-0
       hover:-translate-y-2 hover:shadow-xl bg-gradient-to-br from-gray-700 to-gray-800">
        <div class="flex flex-row items-start justify-between">
            <div class="flex flex-col">
                <div class="text-3xl font-bold text-gray-300 flex flex-row items-center mb-2">
                    <h1>{{ $collection->title }}</h1>
                </div>
                <span class="text-sm mt-1 font-bold text-gray-400 uppercase tracking-wider">
                    @if ($collection->is_public)
                        <span class="fas fa-users"></span>
                        <span class="ml-1">public collection</span>
                    @else
                        <span class="fas fa-lock"></span>
                        <span class="ml-1">private collection</span>
                    @endif
                </span>
            </div>

            @if ($favoriteCollections()->pluck('id')->contains($collection->id))
                <div data-favorite-action="remove" data-favorite-collection="{{ $collection->id }}"
                     class="favorite--collection block fas fa-star fa-2x text-yellow-500 hover:text-gray-600 transition"></div>
            @else
                <div data-favorite-action="add" data-favorite-collection="{{ $collection->id }}"
                     class="favorite--collection block fas fa-star fa-2x hover:text-yellow-500 text-gray-600 transition"></div>
            @endif
        </div>
        <p class="mt-2 text-gray-500 tracking-wide">
            This collection contains
            <strong class="text-gray-100">{{ $collection->flashcards->count() }}</strong>
            flashcards
        </p>
        <div class="border-t border-gray-700 flex flex-row items-center justify-between pt-2 mt-5">
            <div class="flex flex-row items-center">
                <img src="https://gravatar.com/avatar/{{ md5($collection->user->email) }}.png?s=20" alt="Avatar"
                     class="rounded-full shadow mr-2">
                <p class="py-2 text-sm font-bold text-gray-500">{{ $collection->user->name }}</p>
            </div>
            <p class="font-bold text-sm tracking-wide text-gray-500">
                {{ $collection->created_at }}
            </p>
        </div>
    </a>
</div>
