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
        <a href="<?= $pageItems['urlPrefix'] ?>/songs/<?= $song->id ?>/rate?rating=<?= $i ?>"><img height="35" src="<?= $pageItems['urlPrefix'] ?>/img/star.png" alt="star"></a>    
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
    @if (null !== session('user_id')) <div id="newComment">
        @if (!$response['responding'])
            <h4>New comment:</h4>
            <form id="postCommentForm" action="<?= $pageItems['urlPrefix'] ?>/songs/<?= $song->id ?>/comments/post" method="post">
                @csrf
                <textarea name="content"></textarea>

                <button class="btn btn-primary centralizeMargarin" type="submit">Post</button>
            </form>
    @else
            <h4>Response: <span class="time">{{ $response['authorName'] }}: <em>{{ $response['previousContent'] }}</em></span></h4>
            <form id="postCommentForm" action="<?= $pageItems['urlPrefix'] ?>/songs/<?= $song->id ?>/comments/post" method="post">
                @csrf
                <textarea name="content"></textarea>
                <input type="hidden" name="responseTo" value="<?= $response['responseTo'] ?>">
                <button class="btn btn-primary centralizeMargarin" type="submit">Post</button>
            </form> @endif
    </div> 
    @endif
</div>
@include('includes.element-foot')