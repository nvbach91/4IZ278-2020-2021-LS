@extends('layouts.layoutReality')

@section('content')
<div class="container">
<div class="media">
  <img src="{{$offer->PICTURE}}" class="mr-3" alt="Obrázek objektu" style="height: 128px;width: 128px;object-fit: contain;">
  <div class="media-body">
    <h4 class="mt-0">{{$offer->NAME}}</h5>
    <h5>Adresa</h6>
    <p>{{$offer->CITY}}, {{$offer->STREET}}, {{$offer->POSTCODE}}</p>
  </div>
</div>
    <div class="row">
        <div class="col-6 offset-3">
            <ul class="list-group">
                <li class="list-group-item">Cena: {{$offer->PRICE}} kč</li>
                <li class="list-group-item">Kontaktní email: {{$user->email}}</li>
            </ul>
            @if ($offer->STATUS == 1)
            <form action="/~vond07/realitka/offerReservation/{{$offer->ID}}" enctype=multipart/form-data method="post">
                @csrf
                @method('PATCH')
                <input type="hidden" id="RESERVED_BY" name="RESERVED_BY" value="{{Auth::user()->id}}">
                <input type="hidden" id="ID" name="ID" value="{{$offer->ID}}">
                <input type="hidden" id="STATUS" name="STATUS" value="3">
                <button class="btn btn-primary" type="submit" onclick="">Rezervovat</button>
            </form>
            @endif
        </div>
    </div>
</div>
<script>
    
</script>
@endsection


