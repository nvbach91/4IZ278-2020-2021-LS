@extends('layouts.layoutReality')

@section('content')
<div class="container">
        <h1 class="mt-4">Moje nabídky</h1>
        <div class="row">
            <div class="col-md-12 col-12">
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
        <a class="vse-fab" href="{{ url('/offer/create') }}">
            <i class="material-icons">add</i>
        </a>
</div>


@endsection
