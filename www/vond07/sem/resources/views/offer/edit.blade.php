@extends('layouts.layoutReality')

@section('content')
<div class="container">
    
    <form action="/~vond07/realitka/offer/{{$offer->ID}}" enctype=multipart/form-data method="post">
        @csrf
        @method('PATCH')
        <h1>Edit {{$offer->NAME}}</h1>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="NAME" class="">Name</label>

                    <input id="NAME" 
                        type="text" 
                        class="form-control @error('NAME') is-invalid @enderror" 
                        name="NAME" 
                        value="{{ old('NAME') ?? $offer->NAME }}" 
                        autofocus>

                    @error('NAME')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="PICTURE" class="">Obrázek</label>

                    <input id="PICTURE" 
                        type="text" 
                        class="form-control @error('PICTURE') is-invalid @enderror" 
                        name="PICTURE" 
                        value="{{ old('PICTURE') ?? $offer->PICTURE }}" 
                        autofocus>

                    @error('PICTURE')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="SURFACE" class="">Surface</label>

                    <input id="SURFACE" 
                        type="number" 
                        class="form-control @error('SURFACE') is-invalid @enderror" 
                        name="SURFACE" 
                        value="{{ old('SURFACE') ?? $offer->SURFACE }}" >

                    @error('SURFACE')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="SIZE" class="">Size</label>

                    <select id="SIZE" 
                        type="text" 
                        class="form-control @error('SIZE') is-invalid @enderror" 
                        name="SIZE" 
                        value="{{ old('SIZE') ?? $offer->SIZE }}" 
                        autofocus>
                        @foreach ($sizes as $size)
                            <option value="{{ $size->ID }}" {{$size->ID == $offer->SIZE ? 'selected' : ''}}>{{ $size->NAME }}</option>
                        @endforeach
                    </select>

                    @error('SIZE')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="PRICE">Price</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">CZK</span>
                        </div>
                        <input id="PRICE" 
                        type="number" 
                        class="form-control @error('PRICE') is-invalid @enderror" 
                        name="PRICE" 
                        value="{{ old('PRICE') ?? $offer->PRICE }}"
                        placeholder="">
                    </div>
                    @error('PRICE')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="STATUS" class="">Status</label>

                    <select id="STATUS" 
                        type="text" 
                        class="form-control @error('STATUS') is-invalid @enderror" 
                        name="STATUS" 
                        value="{{ old('STATUS') ?? $offer->STATUS }}" 
                        autofocus>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->ID }}" {{$status->ID == $offer->STATUS ? 'selected' : ''}}>{{ $status->NAME }}</option>
                        @endforeach
                    </select>

                    @error('STATUS')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <label for="CITY" class="">City</label>

                    <input id="CITY" 
                        type="text" 
                        class="form-control @error('CITY') is-invalid @enderror" 
                        name="CITY" 
                        value="{{ old('CITY') ?? $offer->CITY }}">

                    @error('CITY')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <label for="STREET" class="">Street</label>

                    <input id="STREET" 
                        type="text" 
                        class="form-control @error('STREET') is-invalid @enderror" 
                        name="STREET" 
                        value="{{ old('STREET') ?? $offer->STREET }}" 
                        autofocus>

                    @error('STREET')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="POSTCODE" class="">Postcode</label>

                    <input id="POSTCODE" 
                        type="text" 
                        class="form-control @error('POSTCODE') is-invalid @enderror" 
                        name="POSTCODE" 
                        value="{{ old('POSTCODE') ?? $offer->POSTCODE  }}" 
                        autofocus>

                    @error('POSTCODE')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-2">
            <div class="form-group">
                    <label for="RESERVED_BY" class="">Rezervováno</label>

                    <select id="RESERVED_BY" 
                        type="text" 
                        class="form-control @error('RESERVED_BY') is-invalid @enderror" 
                        name="RESERVED_BY" 
                        value="{{ old('RESERVED_BY') ?? $offer->RESERVED_BY }}" 
                        autofocus>
                        <option value="">Nikdo</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{$user->id == $offer->RESERVED_BY ? 'selected' : ''}}>{{ $user->name }}</option>
                        @endforeach
                    </select>

                    @error('RESERVED_BY')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <button class="btn btn-primary">Save</button>
        </div>
    </form>



  




</div>
@endsection
