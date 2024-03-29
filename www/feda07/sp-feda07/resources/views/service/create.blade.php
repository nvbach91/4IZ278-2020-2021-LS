@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create service') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('service.create') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <input id="description" type="text"
                                           class="form-control @error('description') is-invalid @enderror"
                                           name="description" value="{{ old('description') }}" required
                                           autocomplete="description" autofocus>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="duration"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Duration in minutes') }}</label>

                                <div class="col-md-6">
                                    {{--                                    Pridano min="0"  +  request ServiceCreate oprava validace--}}
                                    <input id="duration" min="0" type="number"
                                           class="form-control @error('duration') is-invalid @enderror" name="duration"
                                           value="{{ old('duration') }}" required autocomplete="duration" autofocus>

                                    @error('duration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <table class="table table-striped" id="opening-hours-table">
                                <thead>
                                <tr>
                                    <th scope="col">{{ __('Day of week') }}</th>
                                    <th scope="col">{{ __('Time from') }}</th>
                                    <th scope="col">{{ __('Time to') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach (range(0, 6) as $day)
                                    <tr>
                                        <td>
                                           <p>{{App\Constants\TimeConstants::$mapDays[$day]}}</p>
                                        </td>
                                        <td>
                                            <input type="time" id="{{'from-'.$day}}" name="{{'from-'.$day}}"
                                                   >
                                        </td>
                                        <td>
                                            <input type="time" id="{{'to-'.$day}}" name="{{'to-'.$day}}"
                                                   >
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
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
