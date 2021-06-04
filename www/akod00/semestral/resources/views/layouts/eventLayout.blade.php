@extends('layouts.mainLayout')

@section('content')

    @yield('formStart')
    <div class="row">
        <div class="col">
            <div class="row ml-4">
                @yield('eventName')
            </div>
            <div class="row ml-4">
                @yield('contentSub')
            </div>
        </div>
        <div class="col-sm-3 mr-sm-4">

        </div>
    </div>
    <div class="row mt-4">
        <div class="col">
            <div class="row ml-4">
                @yield('contentEvent')
            </div>
        </div>
        <div class="col-sm-3 mr-sm-4">
            <div class="card">
                <div class="card-header">
                    <h3>Description</h3>
                </div>
                <div class="card-body">
                    <p>
                        @yield('contentDesc')
                    </p>
                </div>
            </div>
        </div>
    </div>

    @yield('formEnd')

@endsection
