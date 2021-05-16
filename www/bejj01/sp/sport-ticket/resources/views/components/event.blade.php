 <div class="event-card card mb-3" style="max-width: 540px;">
    <div class="row no-gutters pb-2 card-upper">
        <div class="col-md-4 mt-2 ml-2">
            <div class="image-container d-flex">
                <img src="{{$event->img}}" class="card-img" alt="{{$event->event_name}}">
            </div>
        </div>
        <div class="flex-grow-1">
            <div class="card-body">
                <h5 class="card-title text-center pb-2">{{$event->event_name}}</h5>
                <div class="d-flex justify-content-between">
                    <span class="card-text">
                        @if($event->end_date)
                            {{$event->start_date->format('d. m.')}} - {{$event->formatDate($event->end_date)}}
                        @else
                            {{$event->formatDate($event->start_date)}}
                        @endif
                    </span>
                    <span class="card-text">
                        {{ucfirst($event->sport->sport_name)}}
                    </span>
                </div>
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        @if($event->place_id)
                            <div class="card-text">
                                {{$event->place->place_name}}, {{$event->place->city}}
                            </div>
                        @endif
                    </div>

                    <span class="card-text">
                        {{ucfirst($event->competition)}}
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer buy-section">
        <div class="d-flex align-items-center justify-content-around">
            <p class="card-text mb-0 font-weight-bold">{{$event->formatPrice($event->price)}} CZK / ks</p>
            @if(auth()->check())
                <!-- Do not display buy option for not signed user -->
                <div class="spinner row">
                    <div class="down bg-dark text-white" onclick="this.nextElementSibling.stepDown(1)"><i class="fas fa-minus"></i></div>
                    <input class="spinner-number" type="number" min="1" max="10" value="1">
                    <div class="up bg-dark text-white" onclick="this.previousElementSibling.stepUp(1)"><i class="fas fa-plus"></i></div>
                </div>
                <a href="{{route('buy', $event->event_id)}}" class="btn btn-primary">Buy</a>
            @endif
        </div>
    </div>
</div>
