@extends('layouts.app')

@section('main_col')

    <!-- /.col-lg-3 -->

    <div class="col-lg-9">

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-heading">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-6 my-2">
                                    <h5>Nákupnný košík</h5>
                                </div>
                                <div class="col-lg-6 my-2">
                                    <a href="{{ route('liquor.index') }}" class="btn btn-primary btn-sm btn-block">
                                        Pokračovať v nákupe
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($cart)
                            @foreach($cart->liquors as $liquor )
                            <div id="{{ $liquor->id }}" class="row">
                                <div class="col-lg-2">
                                    <a href="{{ route('liquor.show', ['liquor' => $liquor->id]) }}">
                                        <img class="" src="{{ asset($liquor->image) }}" alt="{{ $liquor->name }}" style="height: 70px; width: auto">
                                    </a>
                                </div>
                                <div class="col-lg-4">
                                    <h4 class="product-name"><strong>{{ $liquor->name }}</strong></h4>
                                    <h4><small>Objem: {{ $liquor->volume }}l Alk.: {{ $liquor->alcohol_percentage }}%</small></h4>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-5 text-right">
                                            <h6><strong>{{ number_format($liquor->price, 2) }}€</strong></h6>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>
                                                <input name="quantity" type="text" class="form-control input-group-sm" readonly value="{{ $liquor->pivot->quantity }}">
                                            </label>
                                        </div>
                                        <div class="col-lg-4">
                                            <remove-from-cart-button liquor-id="{{ $liquor->id }}" target-url="{{ route('cart.remove_from_cart', ['liquor' => $liquor->id]) }}"></remove-from-cart-button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                        <div class="row">
                            <div class="col-lg-8">
                            </div>
                            <div class="col-lg-4">
                                <a href="{{ route('cart.edit') }}" class="btn btn-secondary btn-sm btn-block">
                                    Aktualizovať košík
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer my-2">
                        <div class="row text-center">
                            <div class="col-lg-8">
                                <h4 class="text-right">Celková cena <strong>{{ $cart ? number_format($cart->total_price(), 2) : 0.00 }} €</strong></h4>
                            </div>
                            <div class="col-lg-4">
                                @if($cart->liquors()->exists())
                                    <a href="{{ route('order.create') }}" class="btn btn-success btn-block" role="button">
                                        Dokončiť nákup
                                    </a>
                                @else
                                    <strong>Košík je prázdny</strong>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- /.col-lg-9 -->

@endsection
