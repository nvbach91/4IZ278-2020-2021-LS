@extends('layouts.master')

@section('content')
    <div class="container">
        <h1 class="text-center fw mt-2 mb-3">Events Offer</h1>

        @can('create', \App\Models\Event::class)
            <div class="d-flex justify-content-center mb-3">
                <a href="{{route('event.create')}}" class="btn btn-outline-success"><i class="fas fa-plus me-2"></i>Create new event</a>
            </div>
        @endcan

        <div class="d-flex justify-content-between mb-3 border-bottom pb-3">
            <div class="d-flex sports-filter col-md-4">
                <div>
                    <label for="sport-filter">Filter by Sport</label>
                    {{$filter}}
                    <select id="sport-filter" onchange="fetchData()" name="filter-sport" class="form-select" aria-label="Default select example">
                        <option {{$filter == 'all' ? 'selected' : ''}} value="all">All</option>
                        @if(auth()->check())
                        <option value="favorites">Favorites</option>
                        @endif
                        @foreach($sports as $sport)
                            <option {{$sport->sport_id == $filter ? 'selected' : ''}} value="{{$sport->sport_id}}">{{ucfirst($sport->sport_name)}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="d-flex col-md-4 justify-content-end">
                <div>
                    <label for="sort-by">Sort By</label>
                    <select id="sort-by" onchange="fetchData()" name="sort-by" class="form-select" aria-label="Default select example">
                        <option value="event_id" data-sorting_type="asc" id="id-sort">Default</option>
                        <option value="price" data-sorting_type="asc" id="price-sort">Price</option>
                        <option value="event_name" data-sorting_type="asc" id="alpha-sort">Event Name</option>
                    </select>
                </div>
                <div class="d-flex flex-column align-items-center">
                    <label for="sort-order">Sort Order</label>
                    <a onclick="changeSortOrder()" id="sort-order" class="btn btn-primary text-white" data-sort="asc">
                        <i class="fas fa-sort-amount-up" id="sort-order-icon"></i>
                    </a>
                </div>
            </div>
        </div>

        <div id="render-group-wrapper">
            @include('components.events-group')
        </div>
    </div>
@endsection
