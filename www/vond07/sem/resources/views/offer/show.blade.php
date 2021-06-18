@extends('layouts.layoutReality')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <ul class="list-group">
                <li class="list-group-item">{{$offer->NAME}}</li>
                <li class="list-group-item">{{$offer->STATUS}}</li>
                <li class="list-group-item">{{$offer->CITY}}, {{$offer->STREET}}, {{$offer->POSTCODE}}</li>
                <li class="list-group-item">{{$offer->PRICE}} kč</li>
                <li class="list-group-item">{{$offer->PRICE}}</li>
                <li class="list-group-item">{{$user->email}}</li>
            </ul>
        </div>
    </div>
</div>


@endsection
