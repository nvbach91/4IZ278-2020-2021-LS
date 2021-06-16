@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{route('service.create')}}">+ Add new service</a>
        <div class="card-service">
    @forelse($myServices as $service)
        <div class="card card-service">
            <p>Name of service: {{$service->name}}</p>

        </div>

    @empty
        <p>{{__('No services yet')}}</p>

    @endforelse
        </div>
        <div class="d-flex justify-content-center">
            {!! $myServices->links() !!}
        </div>
    </div>
@endsection
