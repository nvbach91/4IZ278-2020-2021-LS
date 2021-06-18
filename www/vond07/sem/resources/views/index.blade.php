@extends('layouts.layoutReality')

@section('content')
<div class="container"> 
        <h1 class="mt-4">Realitka</h1>
        <div class="row">
            <div class="col-md-12 col-12">
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin pede metus, vulputate nec, fermentum fringilla, vehicula vitae, justo. Mauris elementum mauris vitae tortor. Nullam sapien sem, ornare ac, nonummy non, lobortis a enim. Proin in tellus sit amet nibh dignissim sagittis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quis nibh at felis congue commodo. Nulla quis diam. Duis bibendum, lectus ut viverra rhoncus, dolor nunc faucibus libero, eget facilisis enim ipsum id lacus. Maecenas lorem. Donec vitae arcu. Pellentesque ipsum. Integer pellentesque quam vel velit.</p>
            </div>
        </div>
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
                    <th scope="col">Cena</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($offers as $offer)
                        <tr>
                            <th scope="row">{{ $offer->ID }}</th>
                            <td>{{ $offer->NAME }}</td>
                            <td>{{ $offer->SURFACE }}</td>
                            <td>{{ $offer->STREET }}</td>
                            <td>{{ $offer->STATUS_NAME }}</td>
                            <td>{{ $offer->PRICE }}</td>
                            <td><a class="btn btn-primary" href="{{ url('/offer/' . $offer->ID) }}">See offer</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if (Route::has('login'))
            @auth
            <a class="vse-fab" href="{{ url('/offer/create') }}">
                <i class="material-icons">add</i>
            </a>
            @endauth
        @endif
    </div>
@endsection
