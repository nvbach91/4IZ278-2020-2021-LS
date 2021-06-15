@component('mail::message')
Dobrý deň {{ $order->address->first_name }} {{ $order->address->last_name }},

zasielame Vám detail objednávky.

<h4>Objednávka</h4>

<table class="">
    <thead class="table-dark" style="margin-left: auto; margin-right: auto;">
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Dátum</th>
        <th scope="col">Cena</th>
        <th scope="col">Adresa</th>
        <th scope="col">Produkty</th>
    </tr>
    </thead>
    <tbody>
        <tr class="bg-white">
            <td>{{ $order->id }}</td>
            <td>{{ $order->created_at }}</td>
            <td>{{ $order->total_price }}€</td>
            <td>{{ $order->address->address_1 }}, {{ $order->address->city }} {{ $order->address->zipcode }}, {{ config('enums.countries')[$order->address->country] }}</td>
            <td>
                @foreach($order->liquors as $liquor)
                    {{ $liquor->name }}@if(!$loop->last),@endif
                @endforeach
            </td>
        </tr>
    </tbody>
</table>

@component('mail::button', ['url' => 'https://www.dhl.com/en/express/tracking.html'])
Sledovať objednávku
@endcomponent

Váš tím,<br>
{{ config('app.name') }}
@endcomponent
