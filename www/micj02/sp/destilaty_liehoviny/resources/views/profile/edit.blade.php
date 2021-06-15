@extends('layouts.app')

@section('main_col')

    <!-- /.col-lg-3 -->

    <div class="col-lg-9">

        <div class="row mt-3">
            <div class="col-md-8 order-md-1 py-1">
                <h2>{{ $user->first_name }} {{ $user->last_name }}</h2>
                <h6>{{ $user->email }}</h6>

                <h4 class="my-3">Adresa</h4>

                <!-- FORM -->

                <form class="needs-validation" action="{{ route('profile.update', ['user' => Auth::user()->id]) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name">Meno</label>
                            <input type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name"
                                   value="{{ (old('first_name')) ? old('first_name') : (($user_address) ? $user_address->first_name : "") }}" required="">
                            @if ($errors->has('first_name'))
                                <div class="text-danger">
                                    <strong>Meno je povinný údaj.</strong>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="last_name">Priezvisko</label>
                            <input type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" id="last_name"
                                   value="{{ (old('last_name')) ? old('last_name') : (($user_address) ? $user_address->last_name : "") }}" required="">
                            @if ($errors->has('last_name'))
                                <div class="text-danger">
                                    <strong>Priezvisko je povinný údaj.</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email">Email</label>
                            <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   name="email" id="email"
                                   value="{{ (old('email')) ? old('email') : (($user_address) ? $user_address->email : "") }}"
                                   required="">
                            @if ($errors->has('email'))
                                <div class="text-danger">
                                    <strong>Prosím uveďte platný email.</strong>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="phone_number">Telefónne číslo<span
                                    class="text-muted">(Nepovinný údaj)</span></label>
                            <input type="text"
                                   class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}"
                                   name="phone_number" id="phone_number"
                                   value="{{ (old('phone_number')) ? old('phone_number') : (($user_address) ? $user_address->phone_number : "") }}">
                            @if ($errors->has('phone_number'))
                                <div class="text-danger">
                                    <strong>Prosím uveďte platné telefónne číslo.</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address_1">Adresa</label>
                        <input type="text" class="form-control{{ $errors->has('address_1') ? ' is-invalid' : '' }}" name="address_1" id="address_1"
                               value="{{ (old('address_1')) ? old('address_1') : (($user_address) ? $user_address->address_1 : "") }}" required="">
                        @if ($errors->has('address_1'))
                            <div class="text-danger">
                                <strong>Prosím uveďte dodaciu adresu.</strong>
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="address_2">Adresa extra údaje<span class="text-muted">(Nepovinný údaj)</span></label>
                        <input type="text" class="form-control{{ $errors->has('address_2') ? ' is-invalid' : '' }}" name="address_2" id="address_2"
                               value="{{ (old('address_2')) ? old('address_2') : (($user_address) ? $user_address->address_2 : "") }}">
                        @if ($errors->has('address_2'))
                            <div class="text-danger">
                                <strong>Prosím uveďte platné extra údaje.</strong>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="city">Mesto</label>
                            <input type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" id="city"
                                   value="{{ (old('city')) ? old('city') : (($user_address) ? $user_address->city : "") }}" required="">
                            @if ($errors->has('city'))
                                <div class="text-danger">
                                    <strong>Prosím uveďte a platný názov mesta.</strong>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zipcode">PSČ</label>
                            <input type="text" class="form-control{{ $errors->has('zipcode') ? ' is-invalid' : '' }}" name="zipcode" id="zipcode"
                                   value="{{ (old('zipcode')) ? old('zipcode') : (($user_address) ? $user_address->zipcode : "") }}" required="">
                            @if ($errors->has('zipcode'))
                                <div class="text-danger">
                                    <strong>Prosím uveďte PSČ.</strong>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="country" class="form-label">Krajina</label>
                            <select name="country" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" id="country">
                                @foreach(config('enums.countries') as $country_number => $country_name)
                                    @if(old('country'))
                                        <option {{ old('country') == $country_number ? "selected" : "" }} value="{{ $country_number }}">{{ $country_name }}</option>
                                    @else
                                        <option {{ $user_address and $user_address->country == $country_number ? "selected" : "" }} value="{{ $country_number }}">{{ $country_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @if ($errors->has('country'))
                                <div class="text-danger">
                                    <strong>Prosím vyberte a platný názov krajiny.</strong>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6 mb-6">
                            <label class="form-check-label" for="terms">Súhlasím s podmienkami spracovania osobných údajov</label>
                            <input name="terms" type="checkbox" class="form-check-inline" id="terms" required>
                            @if ($errors->has('terms'))
                                <div class="text-danger">
                                    <strong>Súhlas s podmienkami je povinný.</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <hr class="mb-4">
                    <a href="{{ route('profile.show', ['user' => Auth::user()->id]) }}" role="button" class="btn btn-secondary btn-lg">Späť</a>
                    <button class="btn btn-primary btn-lg float-right" type="submit">Uložiť</button>
                </form>
            </div>
        </div>


    </div>
    <!-- /.col-lg-9 -->

@endsection
