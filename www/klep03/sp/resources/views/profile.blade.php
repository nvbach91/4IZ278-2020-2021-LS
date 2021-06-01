@include('includes.element-head')
<h1>Name: {{ $user->name }}</h1>
Email: {{ $user->email }}
<div class="customProfileText">
    <h3>User info</h3>
    <pre>{{ $user->user_info }}</pre>
</div>
<div class="customProfileText">
    <h3>User Instruments</h3>
    <pre>{{ $user->instruments }}</pre>
</div>
<div id="results">
    <h3>User's added Chords</h3>
    @foreach ($songs as $song)
        <a href="<?= $pageItems['urlPrefix'] ?>/songs/{{ $song->id }}">
            <div class="searchResult">{{ $song->artist }} – {{ $song->name }}</div>
        </a>
    @endforeach
</div>
@include('includes.element-foot')
