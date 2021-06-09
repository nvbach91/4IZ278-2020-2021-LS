@extends('layouts.master')

@section('content')
    <h1 class="text-center fw-bold mt-2 mb-3">Edit Event</h1>

    @include('components.result-messages')

    <div class="d-flex flex-column align-items-center content flex-grow-1">
        <form class="w-75" method="POST" action="{{route('event.edit.do', $event->event_id)}}">
            @csrf
            <div class="col-md-12 mb-2">
                <label for="name">Event name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{is_null(old('name')) ? $event->event_name : old('name')}}" id="name" name="name">
                @error('name')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="col-md-12 mb-2">
                <label for="img">Image URL</label>
                <input class="form-control @error('img') is-invalid @enderror" value="{{is_null(old('img')) ? $event->img : old('img')}}" id="img" name="img">
                @error('img')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="col-md-12 mb-2">
                <label for="price">Price</label>
                <input type="number" min="0.01" step="0.1" class="form-control @error('price') is-invalid @enderror" value="{{is_null(old('price')) ? $event->price : old('price')}}" id="price" name="price">
                @error('price')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="col-md-12 mb-2">
                <label for="comp">Competition</label>
                <input class="form-control @error('comp') is-invalid @enderror" value="{{is_null(old('comp')) ? $event->competition : old('comp')}}" id="comp" name="comp">
                @error('comp')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="col-md-12 mb-2">
                <label for="cap">Capacity</label>
                <input type="number" min="{{$event->capacity}}" step="1" class="form-control @error('cap') is-invalid @enderror" value="{{is_null(old('cap')) ? $event->capacity : old('cap')}}" id="cap" name="cap">
                @error('cap')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="col-md-12 mb-2">
                <label for="desc">Description</label>
                <textarea class="form-control @error('desc') is-invalid @enderror"  id="desc" name="desc">{{is_null(old('desc')) ? $event->description : old('desc')}}</textarea>
                @error('desc')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="d-flex justify-content-center mb-3 mt-3">
                <a class="btn btn-outline-dark" href="{{route('event-detail', $event->event_id)}}">
                    <i class="fas fa-arrow-left me-1"></i>
                    Go back
                </a>
                <button type="submit" class="btn btn-success ms-2">Save Changes</button>
            </div>
        </form>

    </div>
@endsection
