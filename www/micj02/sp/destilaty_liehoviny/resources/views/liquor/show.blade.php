@extends('layouts.app')

@section('main_col')
    <!-- /.col-lg-3 -->

    <div class="col-lg-9">

        <div class="card my-4 text-center">
            <img class="img-fluid mx-auto my-1" src="{{ asset($liquor->image) }}" style="width: 200px; height: auto" alt="{{ $liquor->name }}">
            <div class="card-body">
                <h3 class="card-title">{{ $liquor->name }}</h3>
                <h4>{{ number_format($liquor->price, 2) }}€</h4>
                <p>Objem: {{ $liquor->volume }}l Alk.: {{ $liquor->alcohol_percentage }}%</p>
                <div class="card-footer">
                    <add-to-cart-button target-url="{{ route('cart.add_to_cart', ['liquor' => $liquor->id]) }}"></add-to-cart-button>
                </div>
            </div>
        </div>
        <!-- /.card -->


    </div>
    <!-- /.col-lg-9 -->

@endsection
<script>
    import AddToCartButton from "../../js/components/AddToCartButton";
    export default {
        components: {AddToCartButton}
    }
</script>
