@extends("layout.app")

@section("content")
    <div class="flex flex-col justify-between items-start">
        <div>
            <h1 class="title">
                <span class="text-gray-700">Flashcard</span> 
                <a href="{{ route('collections.flashcards.show', [$flashcard->collection, $flashcard]) }}">
                    {{ $flashcard->title }}
                </a>
            </h1>
        </div>

        <div class="my-5 flex flex-row items-center justify-center">
            <div class="question__control--previous button button--muted mr-2"><i class="fas fa-arrow-left"></i></div>
            <div class="question__control--toggle button button--action mr-2">Toggle reveal</div>
            <div class="question__control--next button button--muted"><i class="fas fa-arrow-right"></i></div>
        </div>

        <div class="mt-2 self-stretch">
            @php $nonce = uniqid("nonce"); @endphp

            @foreach ($questions as $index => $question)
                <div class="{{ $nonce }}_question question @unless($index === 0) question--hidden @endif">
                    <div class="question--question">
                        {{ $question->question }}
                    </div>
                    <div class="question--answer text-center">
                        {{ $question->answer }}
                        @if (isset($question->link_to_external_resource))
                        <br>
                        <div class="mt-5">
                            <a class="question__control--next button button--action"
                               href="{{ $question->link_to_external_resource }}" target="_blank">External resource</a>
                        </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>window.__practice_nonce = "{{ $nonce }}";</script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    <script src="/js/practice.js"></script>
@endsection
