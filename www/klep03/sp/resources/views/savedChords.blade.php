@include('includes.element-head')
@if (isset($results))
    <div>
        <h2>Your saved chords:</h2>
    </div>
    <div id="results">
        @foreach ($songs as $song)
            <a href="/songs/{{ $result->id }}">
                <div class="searchResult">{{ $result->artist }} – {{ $result->name }}</div>
            </a>
        @endforeach
    </div>
@endif

@include('includes.element-foot')
