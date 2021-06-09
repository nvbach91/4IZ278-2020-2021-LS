<div class="event-card card mb-3 me-2 ms-2" style="width: 450px;">
    <div class="d-flex no-gutters pb-2 card-upper">
        <div class="col-md-4 mt-2 ms-2">
            <div class="image-container d-flex">
                <img data-src="{{$event->img}}" src="{{$event->img}}" class="card-img lazyload" alt="{{$event->event_name}}">
            </div>
        </div>
        <div class="flex-grow-1 d-flex flex-column justify-content-between">
            <div class="card-body text-center">
                <h6 class="card-title text-center pb-2 fw-bold">{{$event->event_name}}</h6>
                <div class="card-text">
                    <span class="card-text">
                        @if($event->end_date)
                            {{$event->start_date->format('d. m.')}} - {{$event->formatDate($event->end_date)}}
                        @else
                            {{$event->formatDate($event->start_date)}}
                        @endif
                    </span>
                </div>
                <div class="card-text">
                    {{ucfirst($event->sport->sport_name)}}
                </div>
            </div>
            <div class="d-flex w-100 justify-content-center">
                <a href="{{route('event-detail', $event->event_id)}}" class="btn btn-outline-dark">View details</a>
            </div>
        </div>
    </div>
    <div class="card-footer buy-section">
        <div class="d-flex align-items-center justify-content-center">
            <p class="card-text w-50 mb-0 fw-bold text-center">{{$event->formatPrice($event->price)}} CZK / ks</p>
            <!-- Do not display buy option for not signed user -->
            @if(auth()->check())
                <form class="d-flex w-50 justify-content-center align-items-center" action="{{route('buy', $event->event_id)}}" method="GET">
                    @csrf
                    <div class="spinner d-flex me-3">
                        <div class="down bg-dark text-white" onclick="this.nextElementSibling.stepDown(1)"><i class="fas fa-minus"></i></div>
                        <input name="{{$event->event_id}}" class="spinner-number" type="number" min="1" max="10" value="1">
                        <div class="up bg-dark text-white" onclick="this.previousElementSibling.stepUp(1)"><i class="fas fa-plus"></i></div>
                    </div>
                    <button type="submit" class="ms-3 btn btn-primary text-white">Buy</button>
                </form>
            @endif
        </div>
    </div>
</div>
