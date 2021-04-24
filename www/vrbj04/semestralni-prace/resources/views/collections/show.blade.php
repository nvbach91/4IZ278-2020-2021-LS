@extends("layout.app")

@section("content")
    <div class="flex flex-row justify-between items-center">
        <div>
            <h1 class="title">{{ $collection->title }}</h1>

            <div class="flex flex-row text-sm mt-1 font-bold text-gray-400 uppercase tracking-wider items-center">
                @if ($collection->is_public)
                    <span class="fas fa-users"></span>
                    <span class="ml-1">public collection</span>
                @else
                    <span class="fas fa-lock"></span>
                    <span class="ml-1">private collection</span>
                @endif

                <span class="mx-5">
                    &mdash;
                </span>

                <div class="flex flex-row items-center">
                    <img src="https://gravatar.com/avatar/{{ md5($collection->user->email) }}.png?s=20" alt="Avatar"
                         class="rounded-full shadow mr-2">
                    <p class="py-2 text-sm font-bold text-gray-300">{{ $collection->user->name }}</p>
                </div>

                <span class="mx-5">
                    &mdash;
                </span>

                <p class="font-bold text-sm tracking-wide text-gray-400">
                    {{ $collection->created_at }}
                </p>
            </div>
        </div>

        @can("update", $collection)
            <div class="flex flex-row">
                <a href="{{ route("collections.edit", $collection) }}" class="button mr-2">Edit</a>
                <form action="{{ route("collections.destroy", $collection) }}" method="post">
                    @csrf
                    @method("delete")
                    <button class="button button--danger"
                            onclick="return confirm('Are you sure? This operation will delete all flashcards as well.')">
                        Delete
                    </button>
                </form>
            </div>
        @endcan
    </div>

    @unless (empty($collection->description))
        <div class="mt-5 text-2xl text-gray-500">
            <p>{{ $collection->description }}</p>
        </div>
    @endif

    <div class="my-10 border-t border-gray-800"></div>

    <div class="flex flex-row flex-wrap">
        @can("update", $collection)
        <div class="pr-5 w-1/4">
            <a href="{{ route("collections.flashcards.create", $collection) }}"
               class="flex flex-col w-full h-48 rounded-xl bg-gradient-to-br from-gray-700 to-green-900 items-center justify-center transition transform shadow
            hover:-translate-y-2 hover:shadow-xl">
                <div class="w-16 h-16 bg-green-800 flex items-center justify-center rounded-full">
                    <em class="fas fa-plus text-white text-4xl"></em>
                </div>
                <div class="mt-5">
                    <span class="uppercase text-lg font-bold tracking-wide text-white">Add a new flashcard</span>
                </div>
            </a>
        </div>
        @endcan

        @foreach($collection->flashcards as $flashcard)
            <x-flashcard :flashcard="$flashcard" :collection="$collection"/>
        @endforeach
    </div>
@endsection
