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
                    <div class="card mb-3">
                        <div class="col">
                            <img class="card-img-top"
                                 src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22817%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20817%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1792e1bb9ed%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A41pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1792e1bb9ed%22%3E%3Crect%20width%3D%22817%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22303.6328125%22%20y%3D%22108.45%22%3E817x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
                                 alt="Card image cap">
                        </div>
                        <div class="col">
                            <div class="card-body">
                                <h5 class="card-title">{{$service->name}}</h5>
                                <p class="card-text">{{$service->description}}</p>
                                <p class="card-text"><small class="text-muted">{{$service->duration}}</small></p>
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
