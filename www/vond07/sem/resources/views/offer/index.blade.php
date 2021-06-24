@extends('layouts.layoutReality')

@section('content')
<div class="container">
        <h1 class="mt-4">Moje nabídky</h1>
        <nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Vše</a>
    <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Zarezervované</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
  <div class="col-md-12 col-12 mt-3">
        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nabídka</th>
                <th scope="col">Plocha</th>
                <th scope="col">Ulice</th>
                <th scope="col">Status</th>
                <th scope="col">Velikost</th>
                <th scope="col">Cena</th>
                <th scope="col"></th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($offers as $offer)
                    <tr>
                        <th scope="row">{{ $offer->ID }}</th>
                        <td>{{ $offer->NAME }}</td>
                        <td>{{ $offer->SURFACE }} m2</td>
                        <td>{{ $offer->STREET }}</td>
                        <td>{{ $offer->STATUS_NAME }}</td>
                        <td>{{ $offer->SIZE_NAME }}</td>
                        <td>{{ $offer->PRICE }}</td>
                        <td><a class="btn btn-primary" href="{{ url('/offer/' . $offer->ID) }}">Náhled</a></td>
                        <td><a class="btn btn-primary" href="{{ url('/offer/' . $offer->ID . '/edit') }}">Editace</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
  <div class="col-md-12 col-12 mt-3">
        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nabídka</th>
                <th scope="col">Plocha</th>
                <th scope="col">Ulice</th>
                <th scope="col">Status</th>
                <th scope="col">Velikost</th>
                <th scope="col">Cena</th>
                <th scope="col"></th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($offersReserved as $offerR)
                    <tr>
                        <th scope="row">{{ $offerR->ID }}</th>
                        <td>{{ $offerR->NAME }}</td>
                        <td>{{ $offerR->SURFACE }} m2</td>
                        <td>{{ $offerR->STREET }}</td>
                        <td>{{ $offerR->STATUS_NAME }}</td>
                        <td>{{ $offerR->SIZE_NAME }}</td>
                        <td>{{ $offerR->PRICE }}</td>
                        <td>{{ $offerR->RESERVED_BY_NAME }}</td>
                        <td><a class="btn btn-primary" href="{{ url('/offer/' . $offerR->ID) }}">Náhled</a></td>
                        <td><a class="btn btn-primary" href="{{ url('/offer/' . $offerR->ID . '/edit') }}">Editace</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </div>
</div>
        <div class="row">
            
        <a class="vse-fab" href="{{ url('/offer/create') }}">
            <i class="material-icons">add</i>
        </a>
</div>


@endsection
