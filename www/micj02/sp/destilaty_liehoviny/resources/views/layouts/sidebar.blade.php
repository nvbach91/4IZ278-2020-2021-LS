<div class="col-lg-3">

    <h1 class="my-4">Destiláty a Liehoviny</h1>
    <div class="list-group">
        @foreach(config('enums.categories') as $category_number => $category_name)
            <a href="{{ route('liquor.index', ['category' => $category_number]) }}" class="list-group-item">{{ $category_name }}</a>
        @endforeach
            <a href="{{ route('liquor.index') }}" class="list-group-item">Všetko</a>
    </div>

</div>
