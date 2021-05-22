@include('includes.element-head')
    @foreach ($songArray as $song)
        <h1>{{ $song->name }} – {{ $song->artist }}</h1>
        <div class="textWrap font18">
            <pre><?php echo $song->lyrics_w_chords ?></pre>
        </div>
    @endforeach
@include('includes.element-foot')
