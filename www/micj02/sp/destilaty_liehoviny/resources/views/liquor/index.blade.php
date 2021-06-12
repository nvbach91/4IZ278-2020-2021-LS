@extends('layouts.app')

@section('content')
    @include('liquor/snippets/sidebar')
    <!-- /.col-lg-3 -->

    <div class="col-lg-9">

        <div id="slider" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($carousel_liquors as $index => $slide)
                <li data-target="#slider" data-slide-to="{{ $index }}" class="{{ $index === 0 ? "active" : "" }}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner" role="listbox">
                @foreach($carousel_liquors as $index => $slide)
                <div class="carousel-item slide text-center {{ $index === 0 ? "active" : "" }} card">
                    <a href="/liquor/{{ $slide->id }}"><img class="m-1" src="{{  $slide->image }}" alt="{{ $slide->name }}" style="height: 600px; width: auto"></a>
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#slider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="row">
            @foreach($liquors as $liquor)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 text-center">
                        <a href="/liquor/{{ $liquor->id }}"><img class="m-1" src="{{  $liquor->image }}" alt="" style="height: 300px; width: auto"></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="/liquor/{{ $liquor->id }}">{{ $liquor->name }}</a>
                            </h4>
                            <h5>{{ number_format($liquor->price, 2) }} {{ $liquor->currency }}</h5>
                        </div>
                        <div class="card-footer">
                            <a href="#">
                                <button type="button" class="btn btn-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                                    </svg>
                                    Pridať do košíka
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{ $liquors->links('pagination::bootstrap-4') }}
            </div>
        </div>

    </div>
    <!-- /.col-lg-9 -->
@endsection

