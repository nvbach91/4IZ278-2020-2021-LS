@extends('layouts.navigation')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Potvrďte svoju emailovú adresu') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Potvrdzovací odkaz sme odoslali na Vašu  emailovú adresu.') }}
                        </div>
                    @endif

                    {{ __('Prosím skontrolujte svoju emailovú adresu.') }}
                    {{ __('Ak ste nedostali odkaz') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('kliknite sem pre zaslanie nového odkazu.') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
