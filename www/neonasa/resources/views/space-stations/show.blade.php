@extends("layout.master")
@section("content")
<div class="card" style="width: 18rem;">

  <img src="<?= $station->img ?>" class="card-img-top">

  <div class="card-body">

    <h5 class="card-title">{{ $station->name }}</h5>

    <p class="card-text">{{ $station->gps }}</p>

  </div>

</div>
@endsection