@extends("layout.app")

@section("content")
    <h1 class="title">Edit flashcard <span class="text-gray-500">{{ $flashcard->title }}</span></h1>
    <h2 class="uppercase font-bold ml-1 mt-3 text-sm tracking-wide text-gray-400">{{ $collection->title }}</h2>

    <div class="my-10 border-t"></div>

    <form action="{{ route("collections.flashcards.update", [$collection, $flashcard]) }}" method="post" class="form w-1/2">
        @csrf
        @method("put")
        <div class="mb-5 flex flex-col">
            <label for="title">Title</label>
            <input id="title" type="text" name="title" class="input" value="{{ old("title", $flashcard->title) }}">
        </div>

        <div class="mb-5 flex flex-col">
            <label for="description">Description <span class="label__meta">(optional)</span></label>
            <textarea type="text" id="description" name="description" class="input">{{ old("description", $flashcard->description) }}</textarea>
        </div>

        <div>
            <button class="button">Update</button>
        </div>
    </form>
@endsection
