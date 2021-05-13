@extends("layout.master")
@section("content")
<div class="card" style="width: 18rem;">
    <div class="card-header">
      Galaxies
    </div>
    <ul class="list-group list-group-flush">
      @foreach($galaxies as $galaxy)
        <li class="list-group-item"><a href="./galaxies/<?= $galaxy["id"] ?>">{{ $galaxy->name }}</a></li>
      @endforeach
    </ul>
  </div>
@endsection