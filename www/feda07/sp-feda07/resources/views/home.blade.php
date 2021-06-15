@extends('layouts.app')

@section('content')
    <form method="GET" action="{{ route('home') }}">
        @csrf
        <div class="container" >

            <div class="row row-home">

                <div class="input-group mb-3">
                    <input type="text" name="query" value="{{app('request')->input('query')}}" class="form-control"
                           placeholder="Search" aria-label="Recipient's username"
                           aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </div>

            </div>
            @foreach ($services as $service)
                <a class="row row-home" href="{{ route('service.info', ['id'=>$service->id]) }}">
                    <div class="card card-search mb-3">
                        <div class="col col-home">
                            <img class="card-img-top"
                                 src="{{$service->user->avatar}}"
                                 alt="Card image cap">
                        </div>
                        <div class="col col-home">
                            <div class="card-body-search">
                                <h5 class="card-title">{{$service->name}}</h5>
                                <p class="card-text">Description: {{$service->description}}</p>
                                <p class="card-text">Duration: {{$service->duration}} minutes</p>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach

            <div class="d-flex justify-content-center">
                {!! $services->links() !!}
            </div>
        </div>
    </form>
@endsection
