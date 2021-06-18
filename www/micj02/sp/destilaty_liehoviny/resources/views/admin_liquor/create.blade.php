@extends('layouts.app')

@section('content')
    <!-- /.col-lg-3 -->

    <div class="col-lg-9">
        <div class="row">
            <div class="col-md-8 order-md-1">
                <div class="row">
                    <h1>Pridať alkohol</h1>
                </div>

{{--                $table->string('name');--}}
{{--                $table->string('image');--}}
{{--                $table->integer('category');--}}
{{--                $table->float('volume'); # in liters--}}
{{--                $table->float('alcohol_percentage'); # %--}}
{{--                $table->float('price'); # in €--}}
                <div class="row">
                    <form class="needs-validation" action="{{ route('admin_liquor.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col mb-3">
                                <label for="name">Názov</label>
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       name="name" id="name"
                                       value="{{ old('name') }}"
                                       required="">
                                @if ($errors->has('name'))
                                    <div class="text-danger">
                                        <strong>Chybný Názov.</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="image" class="form-label">Obrázok</label>
                                <input type="file" name="image" value="{{ old('image')}}" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" id="image">
                                @if ($errors->has('image'))
                                    <div class="text-danger">
                                        <strong>Chybný Obrázok.</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="category">Kategória</label>
                                <input type="text"
                                       class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}"
                                       name="category" id="category"
                                       value="{{ old('category') }}"
                                       required="">
                                @if ($errors->has('category'))
                                    <div class="text-danger">
                                        <strong>Chybná Kategória.</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="volume">Objem</label>
                                <input type="text" class="form-control{{ $errors->has('volume') ? ' is-invalid' : '' }}"
                                       name="volume" id="volume"
                                       value="{{ old('volume') }}"
                                       required="">
                                @if ($errors->has('volume'))
                                    <div class="text-danger">
                                        <strong>Chybný Objem.</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="alcohol_percentage">Objem Alk.</label>
                                <input type="text"
                                       class="form-control{{ $errors->has('alcohol_percentage') ? ' is-invalid' : '' }}"
                                       name="alcohol_percentage" id="alcohol_percentage"
                                       value="{{ old('alcohol_percentage') }}"
                                       required="">
                                @if ($errors->has('alcohol_percentage'))
                                    <div class="text-danger">
                                        <strong>Chybný Objem Alk..</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="price">Cena</label>
                                <input type="text" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}"
                                       name="price" id="price"
                                       value="{{ old('price') }}"
                                       required="">
                                @if ($errors->has('price'))
                                    <div class="text-danger">
                                        <strong>Chybný Cena.</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row pt-4">
                            <button class="btn btn-primary">Pridať</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- /.col-lg-9 -->
@endsection

