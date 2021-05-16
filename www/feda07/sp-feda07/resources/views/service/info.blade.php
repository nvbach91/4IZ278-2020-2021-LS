@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card card-info">
            <div class="row-info-provider">
                <div class="card-provider">
                    <div class="col-avatar">
                        <img src="{{$service->user->avatar}}" alt="avatar" class="img-info">
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
    </div>
    </div>
@endsection
