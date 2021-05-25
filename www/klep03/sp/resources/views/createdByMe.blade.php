@include('includes.element-head')
<h3>User's added Chords</h3>
<div id="userSongsToBeEdited">

    @if (isset($songs) and count($songs) > 0)
        @foreach ($songs as $song)
            <a href="/songs/{{ $song->id }}/edit">
                <div class="userSongToBeEdited">{{ $song->artist }} – {{ $song->name }}</div>
            </a>
        @endforeach
    @else
        <div class="searchresult">Seems lonely here :/</div>
    @endif
</div>
@include('includes.element-foot')
