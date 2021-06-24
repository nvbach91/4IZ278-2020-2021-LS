@extends('layouts.layoutReality')

@section('content')
<div class="container">
    
    <form action="/~vond07/realitka/profile/{{$user->id}}" enctype=multipart/form-data method="post">
        @csrf
        @method('PATCH')
        <h1>Editace profilu</h1>
        <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="name" class="">Name</label>

                <input id="name" 
                    type="text" 
                    class="form-control @error('name') is-invalid @enderror" 
                    name="name" 
                    value="{{ old('name') ?? $user->name }}" 
                    autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-6">
                <div class="form-group">
                    <label for="email" class="">Email</label>

                    <input id="email" 
                        type="text" 
                        class="form-control @error('email') is-invalid @enderror" 
                        name="email" 
                        value="{{ old('email') ?? $user->email }}" 
                        autofocus disabled>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        <div class="col-6">
                <div class="form-group">
                    <label for="phone" class="">Telefon</label>

                    <input id="phone" 
                        type="text" 
                        class="form-control @error('phone') is-invalid @enderror" 
                        name="phone" 
                        value="{{ old('phone') ?? $user->phone }}" 
                        autofocus>

                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        
        <div class="col-6">
                <div class="form-group">
                    <label for="reg_number" class="">Reg Číslo</label>

                    <input id="reg_number" 
                        type="text" 
                        class="form-control @error('reg_number') is-invalid @enderror" 
                        name="reg_number" 
                        value="{{ old('reg_number') ?? $user->reg_number }}" 
                        autofocus>

                    @error('reg_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <button class="btn btn-primary">Uložit</button>
</div>
    </div>
</form>

</div>
@endsection
