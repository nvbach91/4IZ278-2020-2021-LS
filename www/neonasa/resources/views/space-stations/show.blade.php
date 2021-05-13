@extends("layout.master")
@section("content")
<div class="card" style="width: 18rem;">

  <img src="<?= $spdetail["img"] ?>" class="card-img-top">

  <div class="card-body">

    <h5 class="card-title">{{ $spdetail["name"] }}</h5>

    <p class="card-text">{{ $spdetail["gps"] }}</p>

  </div>

</div>
@endsection