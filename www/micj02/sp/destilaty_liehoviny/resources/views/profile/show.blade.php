@extends('layouts.app')

@section('main_col')

    <!-- /.col-lg-3 -->

    <div class="col-lg-9">
        <div class="row py-5">
            <div class="col">
                <h2>{{ $user->first_name }} {{ $user->last_name }}</h2>
                <h6>{{ $user->email }}</h6>
                <a href="{{ route('profile.edit', ['user' => Auth::user()->id]) }}">Upraviť profil</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Objednávky</h4>
                <table class="table table-responsive-lg">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Dátum</th>
                        <th scope="col">Cena</th>
                        <th scope="col">Adresa</th>
                        <th scope="col">Produkty</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user->orders as $order)
                        <tr class="bg-white">
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->total_price }}€</td>
                            <td>{{ $order->address->address_1 }}, {{ $order->address->city }} <small>{{ $order->address->zipcode }}</small>, {{ config('enums.countries')[$order->address->country] }}</td>
                            <td>
                                @foreach($order->liquors as $liquor)
                                    {{ $liquor->name }}@if(!$loop->last),@endif
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>
    <!-- /.col-lg-9 -->

@endsection
