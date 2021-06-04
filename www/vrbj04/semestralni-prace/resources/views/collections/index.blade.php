@extends("layout.app")

@section("content")
    <h1 class="title">Flashcard collections</h1>

    <div class="mt-5 mb-10 border-b border-gray-800"></div>

    <div>
        <div class="flex justify-between items-center">
            <h2 class="text-3xl font-bold text-gray-200">Your collections</h2>
            <a href="{{ route("collections.create") }}" class="button">Create a new collection</a>
        </div>
        <div class="flex flex-row flex-wrap mt-6">
            @forelse($owned as $collection)
                <x-flashcard-collection :collection="$collection"/>
            @empty
                <div class="flex-grow flex flex-col items-center px-10 py-20 my-5 bg-gray-800 rounded-xl">
                    <div class="flex items-center justify-center bg-gray-700 w-32 h-32 rounded-full mb-10">
                        <em class="fas fa-inbox text-6xl text-gray-500"></em>
                    </div>
                    <p class="font-bold uppercase tracking-widest text-gray-500">There are no collections yet</p>
                </div>
            @endforelse
        </div>
        @unless($owned->isEmpty()) 
            {{ $owned->links() }}
        @endunless
    </div>

    <div class="mt-5 mb-10 border-b border-gray-800"></div>

    <div>
        <h2 class="text-3xl font-bold text-gray-200">Public collections of other users</h2>
    </div>
    <div class="flex flex-row flex-wrap mt-6">
        @forelse($public as $collection)
            <x-flashcard-collection :collection="$collection"/>
        @empty
            <div class="flex flex-grow flex-col items-center px-10 py-20 my-5 bg-gray-800 rounded-xl">
                <div class="flex items-center justify-center bg-gray-700 w-32 h-32 rounded-full mb-10">
                    <em class="fas fa-inbox text-6xl text-gray-500"></em>
                </div>
                <p class="font-bold uppercase tracking-widest text-gray-500">There are no collections yet</p>
            </div>
        @endforelse
    </div>
    @unless($public->isEmpty()) 
        {{ $public->links() }}
    @endunless
@endsection
