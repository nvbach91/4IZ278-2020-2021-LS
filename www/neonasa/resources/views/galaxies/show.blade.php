@extends("layout.master")
@section("content")
<div class="card" style="width: 18rem;">

<img src="<?= $data["info"]["img"] ?>" class="card-img-top">

<div class="card-body">

  <h5 class="card-title">{{ $data["info"]["name"] }}</h5>

  <p class="card-text">{{ $data["info"]["size"] }}</p>

</div>

<ul class="list-group list-group-flush">

  @foreach($data["stations"] as $station)

    <li class="list-group-item"><a href="./spacestationdetail">{{ $station }}</a></li>

  @endforeach

</ul>

</div>
@endsection