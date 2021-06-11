<div class="col-lg-3">

    <h1 class="my-4">D&L</h1>
    <div class="list-group">
        @foreach(config('enums.categories') as $category_number => $category_name)
            <a href="/?category={{ $category_number }}" class="list-group-item">{{ $category_name }}</a>
        @endforeach
            <a href="/" class="list-group-item">Všetko</a>
    </div>

</div>
