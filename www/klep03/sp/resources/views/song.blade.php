@include('includes.element-head')
<h1>{{ $song->artist }} – {{ $song->name }}</h1>
@if (!$pageItems['anonymous'])
    <div class="miniNavBar">
        @if ($addedToSaved)
            <a class="active item" href="<?= $song->id ?>/removeFromSaved">Remove from my collection</a> 
@else
            <a class="active item" href="<?= $song->id ?>/save">Save to my collection</a>    
        
        @endif
    <div class="item">
        @for ($i = 1; $i <= 5; $i++)
        <a href="/songs/<?= $song->id ?>/rate?rating=<?= $i ?>"><img height="35" src="/img/star.png" alt="star"></a>    
        @endfor
        <span class="item">{{ $ratings['average'] }} ({{ $ratings['count'] }}x)</span>
    </div>
</div>  
@endif
<div class="textWrap font18">
    <pre><?php echo $song->lyrics_w_chords; ?></pre>
</div>
<div id="commentSection">
    <h3>Comments:</h3>
    {{-- <div class="commentDiv">
        <h4>Petr Klepetko<span class="time"> – 19. 11. 1998</span></h4>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ab corrupti, est ipsa vitae illo fuga commodi? Libero accusantium animi repudiandae aliquam a harum hic architecto dolorum nemo, ratione quibusdam molestias?</p>
        <div class="commentResponseDiv">
            <h4>Další klepetko<span class="time"> – 19. 11. 1998</span></h4>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo odio vitae fugiat veritatis libero enim fugit architecto unde harum reprehenderit, quis accusamus asperiores ullam earum. Deleniti ea consectetur alias voluptatum. </p>
            <div class="commentResponseDiv">
                <h4>Další klepetko<span class="time"> – 19. 11. 1998</span></h4>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo odio vitae fugiat veritatis libero enim fugit architecto unde harum reprehenderit, quis accusamus asperiores ullam earum. Deleniti ea consectetur alias voluptatum. </p>
            </div>
        </div>
    </div>
    <div class="commentDiv">
        <h4>Petr Klepetko<span class="time"> – 19. 11. 1998</span></h4>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ab corrupti, est ipsa vitae illo fuga commodi? Libero accusantium animi repudiandae aliquam a harum hic architecto dolorum nemo, ratione quibusdam molestias?</p>
        <div class="commentResponseDiv">
            <h4>Další klepetko<span class="time"> – 19. 11. 1998</span></h4>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo odio vitae fugiat veritatis libero enim fugit architecto unde harum reprehenderit, quis accusamus asperiores ullam earum. Deleniti ea consectetur alias voluptatum. </p>
        </div>
    </div> --}}

    <?= $commentsFormatted ?>
    <div id="newComment">
        <h4>New comment:</h4>
        <form id="postCommentForm">
            @csrf
            <textarea name="content"></textarea>

            <button class="btn btn-primary centralizeMargarin" type="submit">Post</button>
        </form>
    </div>
</div>
@include('includes.element-foot')
