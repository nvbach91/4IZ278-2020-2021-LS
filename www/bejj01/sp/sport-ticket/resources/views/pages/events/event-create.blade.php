@extends('layouts.master')

@section('content')
    <h1 class="text-center fw-bold mt-2 mb-3">Create New Event</h1>

    @include('components.result-messages')

    <div class="d-flex flex-column align-items-center content flex-grow-1">
        <form class="w-75" method="POST" action="{{route('event.create.do')}}">
            @csrf
            <div class="col-md-12 mb-2">
                <label for="name">Event name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" id="name" placeholder="Enter name" name="name">
                @error('name')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="col-md-12 mb-2">
                <label for="start">Start Date</label>
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
            <div class="col-md-12 mb-2">
                <label for="name">Sport name</label>
                <input type="text" class="form-control @error('sport') is-invalid @enderror" value="{{old('sport')}}" id="sport" placeholder="Enter sport name" name="sport">
                @error('sport')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="col-md-12 mb-2">
                <label for="img">Image URL</label>
                <input class="form-control @error('img') is-invalid @enderror" value="{{old('img')}}" id="img" name="img" placeholder="Enter image URL">
                @error('img')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="col-md-12 mb-2">
                <label for="price">Price</label>
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
                <label for="cap">Capacity</label>
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

    </div>
@endsection
