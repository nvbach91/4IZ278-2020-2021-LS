@extends("layout.master")
@section("content")

@foreach($stations as $station)
<div class="card" style="width: 18rem;">

  <img src="<?= $station->img ?>" class="card-img-top">

  <div class="card-body">
    <h5 class="card-title">{{ $station->name }}</h5>
  </div>

</div>
@endforeach

@endsection