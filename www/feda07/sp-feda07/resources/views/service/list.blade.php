@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{route('service.create')}}">+ Add new service</a>
        <div class="card-service">
    @forelse($myServices as $service)
        <div class="card card-service">
            <p>Name of service: {{$service->name}}</p>

        </div>

                    <a class="btn btn-secondary" href="{{ route('service.delete') }}"
                       onclick="event.preventDefault();
                           document.getElementById('service-delete-form-{{$service->id}}').submit();">
                        {{ __('Delete') }}
                    </a>

                    <form id="service-delete-form-{{$service->id}}" action="{{ route('service.delete') }}" method="POST" class="d-none">
                        <input name="serviceId" type="hidden" value="{{$service->id}}">
                        @csrf
                    </form>


    @empty
        <p>{{__('No services yet')}}</p>

    @endforelse
        </div>
        <div class="d-flex justify-content-center">
            {!! $myServices->links() !!}
        </div>
    </div>
@endsection
