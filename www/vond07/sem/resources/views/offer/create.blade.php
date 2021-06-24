@extends('layouts.layoutReality')

@section('content')
<div class="container">
    
    <form action="/~vond07/realitka/offer" enctype=multipart/form-data method="post">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="NAME" class="">Name</label>

                    <input id="NAME" 
                        type="text" 
                        class="form-control @error('NAME') is-invalid @enderror" 
                        name="NAME" 
                        alue="{{ old('NAME') }}" 
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
                        value="{{ old('PICTURE') ?? '' }}" 
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
                        value="{{ old('SURFACE') }}" >

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
                        value="{{ old('SIZE') }}" 
                        autofocus>
                        <option selected>Choose size</option>
                        @foreach ($sizes as $size)
                            <option value="{{ $size->ID }}">{{$size->NAME}}</option>
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
                        value="{{ old('PRICE') }}"
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
                        value="{{ old('STATUS') }}" 
                        autofocus>
                        <option selected>Choose status</option>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->ID }}">{{$status->NAME}}</option>
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
                        alue="{{ old('CITY') }}" 
                        autofocus>

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
                        alue="{{ old('STREET') }}" 
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
                        alue="{{ old('POSTCODE') }}" 
                        autofocus>

                    @error('POSTCODE')
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
