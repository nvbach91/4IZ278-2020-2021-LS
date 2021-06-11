@extends('layouts.master')

@section('content')
    <h1 class="text-center fw-bold mt-2 mb-3">Create New Event</h1>

    @include('components.result-messages')

    <div class="d-flex flex-column align-items-center content flex-grow-1">
        <form class="w-75" method="POST" action="{{route('event.create.do')}}">
            @csrf
            <div class="col-md-12 mb-2">
                <label for="name">Event name<span class="text-muted">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" id="name" placeholder="Enter name" name="name">
                @error('name')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="col-md-12 mb-2">
                <label for="start">Start Date<span class="text-muted">*</span></label>
                <input type="date" class="form-control @error('start') is-invalid @enderror" value="{{old('start')}}" id="start" placeholder="Enter start date" name="start">
                @error('start')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="col-md-12 mb-2">
                <label for="end">End Date</label>
                <input type="date" class="form-control @error('end') is-invalid @enderror" value="{{old('end')}}" id="end" placeholder="Enter end date" name="end">
                @error('end')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="col-md-12 mb-2 d-flex flex-column">
                <label class="mb-2">Sport<span class="text-muted">*</span></label>
                <div>
                    <input type="checkbox" id="create-checkbox" class="form-check-input" onclick="handleSportCheckbox()">
                    <label for="create-checkbox">Create new sport</label>
                </div>

                <div class="d-flex">
                    <div class="col-md-6 pe-2">
                        <label for="select-sport">Select from existing sports</label>
                        <select class="form-select" name="sport" id="select-sport">
                            @foreach($sports as $sport)
                                <option value="{{$sport->sport_name}}">{{$sport->sport_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 ps-2">
                        <label for="sport-input">New sport name</label>
                        <input type="text" disabled class="form-control @error('new_sport') is-invalid @enderror" value="{{old('new_sport')}}" id="sport-input" placeholder="Enter sport name" name="new_sport">
                        @error('new_sport')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <label for="sport-input-img">New sport image</label>
                        <input type="text" disabled class="form-control @error('new_sport_img') is-invalid @enderror" value="{{old('new_sport_img')}}" id="sport-input-img" placeholder="Enter sport image" name="new_sport_img">
                        @error('new_sport_img')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-2">
                <label for="img">Image URL<span class="text-muted">*</span></label>
                <input class="form-control @error('img') is-invalid @enderror" value="{{old('img')}}" id="img" name="img" placeholder="Enter image URL">
                @error('img')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="col-md-12 mb-2">
                <label for="price">Price<span class="text-muted">*</span></label>
                <input type="number" min="0" class="form-control @error('price') is-invalid @enderror" value="{{is_null(old('price')) ? 0 : old('price')}}" id="price" name="price" placeholder="Enter price">
                @error('price')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="col-md-12 mb-2">
                <label for="comp">Competition</label>
                <input class="form-control @error('comp') is-invalid @enderror" value="{{old('comp')}}" id="comp" name="comp" placeholder="Enter Competition name">
                @error('comp')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="col-md-12 mb-2">
                <label for="cap">Capacity<span class="text-muted">*</span></label>
                <input type="number" min="1" step="1" class="form-control @error('cap') is-invalid @enderror" value="{{is_null(old('cap')) ? 1 : old('cap')}}" id="cap" name="cap" placeholder="Enter capacity">
                @error('cap')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="col-md-12 mb-2">
                <label for="desc">Description</label>
                <textarea class="form-control @error('desc') is-invalid @enderror"  id="desc" name="desc">{{old('desc')}}</textarea>
                @error('desc')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="d-flex justify-content-center mb-3 mt-3">
                <a class="btn btn-outline-dark" href="{{route('events')}}">
                    <i class="fas fa-arrow-left me-1"></i>
                    Go back
                </a>
                <button type="submit" class="btn btn-success ms-2">Create Event</button>
            </div>
        </form>

        <small class="d-flex w-75 border-top mb-3 text-muted">* - Mandatory fields</small>
    </div>
@endsection
