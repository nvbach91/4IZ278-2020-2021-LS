@extends('layouts.app')

@section('content')
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
                            <add-to-cart-button liquor-id="{{ $liquor->id }}"></add-to-cart-button>
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

