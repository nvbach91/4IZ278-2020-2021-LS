@extends('layouts.app')

@section('content')

    <div class="container">
        <a href="{{route('service.create')}}">+ Add new service</a>
        <div class="card-service">
            @forelse($myServices as $service)
                <div class="card card-service">
                    <p>Name of service: {{$service->name}}</p>
                    <div class="row">
                        <div class="col-list-services">
                            <a class="btn btn-secondary delete-button" href="{{ route('service.delete') }}"
                               serviceId="{{$service->id}}">{{ __('Delete') }}</a>

                            <form id="service-delete-form-{{$service->id}}" action="{{ route('service.delete') }}"
                                  method="POST"
                                  class="d-none">
                                <input name="serviceId" type="hidden" value="{{$service->id}}">
                                @csrf
                            </form>
                        </div>
                        <div class="col-list-services">
                            <a class="btn btn-primary"
                               href="{{route('service.edit', $service->id)}}">{{ __('Edit') }}</a>
                        </div>
                    </div>
                    <div class="container-reservation-my-service">
                        <div class="row">
                            @foreach($service->reservations as $reservation)
                                <div class="col col-reservation-my-service">
                                    <p>{{$reservation->date_from->format(\App\Constants\TimeConstants::$date)}}  {{$reservation->date_from->format(\App\Constants\TimeConstants::$time)}}
                                        -{{$reservation->date_to->format(\App\Constants\TimeConstants::$time)}}
                                        : {{$reservation->user->name}}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @empty
                        <p>{{__('No services yet')}}</p>

                    @endforelse
                </div>
        </div>
        <div class="d-flex justify-content-center">
            {!! $myServices->links() !!}
        </div>
    </div>

    <script type="text/javascript">
        function confirmDelete(event, id) {
            event.preventDefault();
            if (confirm('Do you want to delete the service?')) {
                id = 'service-delete-form-' + id;
                document.getElementById(id).submit();
            }
        }

        $('.delete-button').click((event) => {
            event.preventDefault()
            const target = $(event.target)
            confirmDelete(event, target.attr("serviceId"))
        })
    </script>

@endsection
