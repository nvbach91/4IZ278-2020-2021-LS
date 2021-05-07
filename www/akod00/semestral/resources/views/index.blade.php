@extends('layouts.mainLayout')

@section('title')
    Home
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="card" style="width: 28%; height: 265px;">
            <div class="card-header d-none d-lg-inline">
                <h2 class="text-center mb-0">Authentication</h2>
            </div>
            <div class="card-body">
                <div class="row h-100">
                    <div class="col">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <a href="{{ route("login")  }}" class="btn btn-primary btn-lg active w-100 mb-3" role="button" aria-pressed="true">
                                <i class="fa fa-github-alt mr-2 d-none d-sm-inline"></i>
                                Login<span class="d-none d-lg-inline"> with GitHub</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
