@include('includes.element-head')
<form id="songEditForm" method="post">
    @csrf
    <h1><textarea name="artist">{{ $song->artist }}</textarea> – <textarea name="name">{{ $song->name }}</textarea></h1>

    <div class="textWrap font18">
        <textarea id="lyrics_w_chords" name="lyrics_w_chords"><?php echo $song->lyrics_w_chords; ?></textarea>
    </div>
    <div class="divForButton"><button type="submit" class="btn btn-primary">Save</button></div>
</form>
@include('includes.element-foot')
