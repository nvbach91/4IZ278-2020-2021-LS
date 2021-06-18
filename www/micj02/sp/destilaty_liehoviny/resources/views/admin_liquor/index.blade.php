@extends('layouts.app')

@section('content')
    <!-- /.col-lg-3 -->

    <div class="col-lg-9">
        <div class="row">
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Alkoholy</h4><a href="{{ route('admin_liquor.create') }}">Pridať</a>
                <table class="table table-responsive-lg">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Dátum</th>
                        <th scope="col">Obrázok</th>
                        <th scope="col">Názov</th>
                        <th scope="col">Cena</th>
                        <th scope="col">Info</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($liquors as $liquor)
                        <tr class="bg-white">
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $liquor->id }}</td>
                            <td>{{ $liquor->created_at }}</td>
                            <td><img class="img-fluid mx-auto my-1" src="{{ asset($liquor->image) }}" style="width: 200px; height: auto" alt="{{ $liquor->name }}"></td>
                            <td><a href="{{ route('admin_liquor.edit', ['liquor' => $liquor->id]) }}">{{ $liquor->name }}</a></td>
                            <td>{{ $liquor->price }}€</td>
                            <td>
                                Objem: {{ $liquor->volume }}l Alk.: {{ $liquor->alcohol_percentage }}%
                            </td>
                            <td>
                                <form action="{{ route('admin_liquor.delete', ['liquor' => $liquor->id]) }}" method="post">
                                    @csrf
                                    <a href="javascript:" onclick="parentNode.submit();">Zmazať</a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <!-- /.row -->
        <div class="row">
            <div class="col-8 d-flex justify-content-center">
                {{ $liquors->links('pagination::bootstrap-4') }}
            </div>
        </div>

    </div>
    <!-- /.col-lg-9 -->
@endsection

