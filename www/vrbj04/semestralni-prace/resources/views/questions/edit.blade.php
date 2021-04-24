@extends("layout.app")

@section("content")
    <div class="flex flex-row justify-between items-start">
        <div>
            <h1 class="title">Edit question</h1>
            <div class="flex flex-row text-sm mt-3 font-bold text-gray-400 uppercase tracking-wider items-center">
                <a href="{{ route("collections.show", $collection) }}" class="font-bold hover:text-blue-500">
                    {{ $collection->title }}
                </a>

                <div class="mx-5">&mdash;</div>

                <a href="{{ route("collections.flashcards.show", [$collection, $flashcard]) }}"
                   class="font-bold hover:text-blue-500">
                    {{ $flashcard->title }}
                </a>
            </div>
        </div>
        <form action="{{ route("collections.flashcards.questions.destroy", [$collection, $flashcard, $question]) }}" method="post">
            @csrf
            @method("delete")
            <button class="button button--danger" onclick="return confirm('Are you sure?')">Delete question</button>
        </form>
    </div>

    <div class="my-10 border-t"></div>

    <form action="{{ route("collections.flashcards.questions.update", [$collection, $flashcard, $question]) }}"
          method="post" class="form">
        @csrf
        @method("put")
        <div class="flex flex-row">
            <div class="w-1/2 pr-2">
                <div class="mb-5 flex flex-col">
                    <label for="question">Question</label>
                    <textarea id="question" name="question" class="input"
                              rows="5">{{ old("question", $question->question) }}</textarea>
                </div>
            </div>

            <div class="w-1/2">
                <div class="mb-5 flex flex-col">
                    <label for="answer">Description</label>
                    <textarea id="answer" name="answer" class="input"
                              rows="5">{{ old("answer", $question->answer) }}</textarea>
                </div>
            </div>
        </div>

        <div class="mb-5 flex flex-col">
            <label for="external_resource_link">External resource link <span
                    class="label__meta">(optional)</span></label>
            <input type="text" id="external_resource_link" name="external_resource_link" class="input"
                   value="{{ old("external_resource_link", $question->external_resource_link) }}">
        </div>

        <div>
            <button class="button">Update question</button>
        </div>
    </form>
@endsection
