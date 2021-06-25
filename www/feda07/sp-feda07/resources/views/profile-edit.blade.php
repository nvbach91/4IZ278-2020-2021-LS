@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ ('Edit profile') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.edit.post') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ ('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name',optional(Auth::user())->name) }}" autocomplete="name"
                                           autofocus placeholder="{{old('name')}}">


                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="surname"
                                       class="col-md-4 col-form-label text-md-right">{{ ('Surname') }}</label>

                                <div class="col-md-6">
                                    <input id="surname" type="text" class="form-control" name="surname"
                                           value="{{ old('surname',optional(Auth::user())->surname) }}"
                                           autocomplete="surname" autofocus>


                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phoneNumber"
                                       class="col-md-4 col-form-label text-md-right">{{ ('Phone number') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control" name="phoneNumber"
                                           value="{{ old('phoneNumber',optional(Auth::user())->phone) }}"
                                           autocomplete="phoneNumber" autofocus>


                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="aboutMe"
                                       class="col-md-4 col-form-label text-md-right">{{ ('About me') }}</label>

                                <div class="col-md-6">
                                    <input id="aboutMe" type="text" class="form-control" name="aboutMe"
                                           value="{{ old('aboutMe',optional(Auth::user())->about_me) }}"
                                           autocomplete="aboutMe">


                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="avatar"
                                       class="col-md-4 col-form-label text-md-right">{{ ('Avatar') }}</label>
                                <div class="col">
                                    <input type="file" class="form-control" accept="image/*" id="avatar" name="avatar"/>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Edit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection