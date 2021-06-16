@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card card-info">
            <div class="row-info-provider">
                <div class="card-provider">
                    <div class="col-avatar">
                        <img src="{{asset($service->user->avatar)}}" alt="avatar" class="img-info">
                    </div>
                    <div class="col ">
                        <div class="row">
                            <h2>{{'Provider of service'}}: {{$service->user->name}} {{$service->user->surname}}</h2>
                        </div>
                        <div class="row">
                            <h2>{{'Phone number'}}: {{$service->user->phone}}</h2>
                        </div>
                        <div class="row">
                            <h2>{{'Email'}}: {{$service->user->email}}</h2>
                        </div>
                        <div class="row">
                            <h2>{{'Information'}}: </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-info-service">
                <div class="card-service ">
                    <div class="row">
                        <h2>{{'Name'}}: {{$service->name}}</h2>
                    </div>
                    <div class="row">
                        <h2>{{'Description'}}: {{$service->description}}</h2>
                    </div>
                    <div class="row">
                        <h2>{{'Duration'}}: {{$service->duration}} {{__('minutes')}}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-opening">
            <div class="row">
                <h1>{{'Opening hours:'}}</h1>
            </div>
            <div class="row">
                @foreach($openingHours as $day)
                    <div class="col-week">
                        <h1 class="weekday">{{$day->name}}</h1>
                        @foreach($day->openingHours as $hours)
                            <p>{{$hours->from->format(\App\Constants\TimeConstants::$time)}}
                                - {{$hours->to->format(\App\Constants\TimeConstants::$time)}}</p>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        <div class="selection-time">
        <form method="POST" action="{{ route('service.reserve') }}">
            @csrf
            <input name="serviceId" value="{{$service->id}}" hidden/>
            <div class="card card-choose">
                <div class="row">
                    <div class="form-group">
                        <label for="dateSelection"> Сhoose the day for your reservation </label>
                        <select class="custom-select" id="dateSelection" name="dateSelection">
                            <option selected>Open this select menu</option>
                            @foreach($daysList as $day)
                                <option
                                    value="{{$day->getTimestamp()}}">{{$day->format(\App\Constants\TimeConstants::$date)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="timeListSelection"> Сhoose the time for your reservation </label>
                    <select class="custom-select" id="timeListSelection" name="timeListSelection">
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Reserve</button>
                </div>

            </div>

        </form>
        </div>
        <script type="text/javascript">

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#dateSelection").change((e) => {
                e.preventDefault();
                $("#timeListSelection").find('option').remove()
                const timestamp = $("#dateSelection").val();
                $.ajax({
                    type: 'GET',
                    url: "{{ route('service.getAvailableDays', [$service->id, ':timestamp']) }}".replace(":timestamp", timestamp),
                    success: function (data) {
                        console.log(data)
                        $("#timeListSelection").find('option').remove()
                        const terms = data.availableTimes;
                        if (terms.length === 0) {
                            const opt = $("<option />");
                            opt.val(null)
                            opt.text('no available terms')
                            opt.prop('disabled', true)
                            $("#timeListSelection").append(opt);
                        }
                        for (const i of terms) {
                            const opt = $("<option />");
                            opt.val(i.from)
                            opt.text(moment(i.from).format('HH:mm') + " - " + moment(i.to).format('HH:mm'))
                            opt.prop('disabled', i.isOccupated)
                            $("#timeListSelection").append(opt);
                        }

                        $("#timeListSelection").first().prop('selected')

                    }
                });
            })
        </script>
@endsection
