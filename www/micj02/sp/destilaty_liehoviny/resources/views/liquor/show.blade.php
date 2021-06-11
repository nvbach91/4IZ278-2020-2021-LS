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
                <p>Objem: {{ $liquor->volume }}l</p>
                <p>Alk.: {{ $liquor->alcohol_percentage }}%</p>
            </div>
        </div>
        <!-- /.card -->


    </div>
    <!-- /.col-lg-9 -->

@endsection
