@include('includes.element-head')
<div>
    <h1>Your saved chords:</h2>
</div>
@if (isset($songs))
    <div id="results">
        @foreach ($songs as $song)
            <a href="/songs/{{ $song->id }}">
                <div class="searchResult">{{ $song->artist }} – {{ $song->name }}</div>
            </a>
        @endforeach
    </div>
@else

@endif

@include('includes.element-foot')
