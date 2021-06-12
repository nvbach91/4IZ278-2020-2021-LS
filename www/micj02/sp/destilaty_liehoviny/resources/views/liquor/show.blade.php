@extends('layouts.app')

@section('content')

    @include('liquor/snippets/sidebar')
    <!-- /.col-lg-3 -->

    <div class="col-lg-9">

        <div class="card my-4 text-center">
            <img class="img-fluid mx-auto my-1" src="{{ $liquor->image }}" style="width: 200px; height: auto" alt="">
            <div class="card-body">
                <h3 class="card-title">{{ $liquor->name }}</h3>
                <h4>{{ $liquor->price }} {{ $liquor->currency }}</h4>
                <p>Objem: {{ $liquor->volume }}l Alk.: {{ $liquor->alcohol_percentage }}%</p>
                <p>
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
                </p>
            </div>
        </div>
        <!-- /.card -->


    </div>
    <!-- /.col-lg-9 -->

@endsection
