@extends("layout.app")

@section("content")
    <h1 class="title">Add a new question</h1>
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

    <div class="my-10 border-t"></div>

    <form action="{{ route("collections.flashcards.questions.store", [$collection, $flashcard]) }}" method="post"
          class="form">
        @csrf
        <div class="flex flex-row">
            <div class="w-1/2 pr-2">
                <div class="mb-5 flex flex-col">
                    <label for="question">Question</label>
                    <textarea id="question" name="question" class="input" rows="5">{{ old("question") }}</textarea>
                </div>
            </div>

            <div class="w-1/2">
                <div class="mb-5 flex flex-col">
                    <label for="answer">Description</label>
                    <textarea id="answer" name="answer" class="input" rows="5">{{ old("answer") }}</textarea>
                </div>
            </div>
        </div>

        <div class="mb-5 flex flex-col">
            <label for="link_to_external_resource">External resource link <span class="label__meta">(optional)</span></label>
            <input type="text" id="link_to_external_resource" name="link_to_external_resource" class="input">
        </div>

        <div>
            <button class="button mr-2" name="another">Create question and add another</button>
            <button class="button button--muted">Create question</button>
        </div>
    </form>
@endsection
