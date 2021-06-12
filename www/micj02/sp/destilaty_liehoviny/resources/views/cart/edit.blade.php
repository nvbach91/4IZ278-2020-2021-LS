@extends('layouts.app')

@section('content')

    @include('liquor/snippets/sidebar')
    <!-- /.col-lg-3 -->

    <div class="col-lg-9">

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <div class="row">
                                <div class="col-lg-6 my-2">
                                    <h5>Nákupnný košík</h5>
                                </div>
                                <div class="col-lg-6 my-2">
                                    <button type="button" class="btn btn-primary btn-sm btn-block">
                                        Pokračovať v nákupe
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-2"><img src="https://via.placeholder.com/150" alt="" style="height: 70px; width: auto">
                            </div>
                            <div class="col-lg-4">
                                <h4 class="product-name"><strong>Product name</strong></h4><h4><small>Product description</small></h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-5 text-right">
                                        <h6><strong>25.00 <span class="text-muted">x</span></strong></h6>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>
                                            <input name="quantity" type="text" class="form-control input-group-sm" value="1">
                                        </label>
                                    </div>
                                    <div class="col-lg-4">
                                        <button type="button" class="btn btn-danger btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-8">
                            </div>
                            <div class="col-lg-4">
                                <button type="button" class="btn btn-secondary btn-sm btn-block">
                                    Aktualizovať košík
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer my-2">
                        <div class="row text-center">
                            <div class="col-lg-8">
                                <h4 class="text-right">Celková cena <strong>$50.00</strong></h4>
                            </div>
                            <div class="col-lg-4">
                                <button type="button" class="btn btn-success btn-block">
                                    Dokončiť nákup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- /.col-lg-9 -->

@endsection
