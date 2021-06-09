@extends('layouts.master')

@section('content')
    <h1 class="text-center fw-bold mt-2 mb-3">Sports</h1>

    @include('components.result-messages')

    @can('create', App\Models\Sport::class)
        <div class="d-flex flex-column align-items-center justify-content-center mb-2 mt-2">
            <h3>Add new sport</h3>
            <div class="create-sport" id="create-sport">
                <form action="{{route('sport.create')}}" method="POST" class="mb-4 text-center">
                    @csrf
                    <div class="mb-2">
                    <input type="text" value="{{old('new-name')}}" class="form-control" placeholder="Enter new sport name" name="new-name">
                        @error('start')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <input type="text" value="{{old('new-img')}}" class="form-control" placeholder="Enter new image URL" name="new-img">
                        @error('start')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success text-white"><i class="fas fa-plus me-1"></i>Create sport</button>
                </form>
            </div>
        </div>
    @endcan

    <div class="container d-flex flex-column align-items-center">
        <div class="d-flex flex-wrap justify-content-center">
            @foreach($sports as $sport)
                <div class="d-flex flex-column p-3 me-4">
                    <h5 class="fw-bold text-center mb-0 pb-2 pt-2 bg-secondary text-white">{{ucfirst($sport->sport_name)}}</h5>
                    <div class="sport-image">
                        <img class="w-100 lazyload" data-src="{{$sport->img}}" alt="{{$sport->sport_name}} image">
                        <div class="sport-event-number w-100 h-100">{{$sport->events->count()}} events</div>
                    </div>
                    @if(auth()->check())
                        @can('delete', $sport)
                            <div class="text-dark">
                                <button type="button" class="w-100 btn btn-warning br-0" onclick="showOrHideChangeImageInput({{$sport->sport_id}})"><i class="fas fa-edit"></i>Update sport</button>
                                <div class="change-image-input" id="change-image-input-{{$sport->sport_id}}">
                                    <form action="{{route('sport.update', $sport->sport_id)}}" method="POST" class="mb-4 mt-4 text-center">
                                        @csrf
                                        <input type="text" value="{{$sport->sport_name}}" class="form-control mb-2 p-0" placeholder="Enter new sport name" name="name">
                                        <input type="text" value="{{$sport->img}}" class="form-control mb-2 p-0" placeholder="Enter new image URL" name="img">
                                        <button type="submit" class="btn btn-success text-white"><i class="fas fa-save me-1"></i>Save</button>
                                    </form>
                                </div>
                            </div>
                        @endcan
                        <div class="d-flex w-100 mb-2">
                            <button class="w-100 btn btn-primary br-0 text-white" onclick="favoriteSport({{$sport->sport_id}})">
                                <i id="{{$sport->sport_id}}" class="fas {{auth()->user()->favoriteSports()->find($sport->sport_id) ? 'fa-thumbs-down' : 'fa-thumbs-up' }}"></i>
                            </button>
                            @can('delete', $sport)
                                <form action="{{route('sport.delete', $sport->sport_id)}}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-100 btn btn-danger text-white br-0"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            @endcan
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
