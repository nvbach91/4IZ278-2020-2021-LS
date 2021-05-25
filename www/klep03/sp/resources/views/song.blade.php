@include('includes.element-head')
<h1>{{ $song->name }} – {{ $song->artist }}</h1>
@if (!$pageItems['anonymous'])
    <div class="miniNavBar">
        @if ($addedToSaved)
            <a class="active item" href="<?= $song->id ?>/removeFromSaved">Remove from my collection</a> 
@else
            <a class="active item" href="<?= $song->id ?>/save">Save to my collection</a>    
        
        @endif
    <div class="item">
        @for ($i = 1; $i <= 5; $i++)
        <a href="songs/<?= $song->id ?>/rate?rating=<?= $i ?>"><img height="35" src="/img/star.png" alt="star"></a>    
        @endfor
        <span class="item">3.5 (58x)</span>
    </div>
</div>  
@endif
<div class="textWrap font18">
    <pre><?php echo $song->lyrics_w_chords; ?></pre>
</div>
@include('includes.element-foot')
