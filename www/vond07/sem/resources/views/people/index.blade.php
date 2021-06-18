@extends('layouts.layoutReality')

@section('content')
@csrf
<div class="container"> 
    <h1 class="mt-4">Uživatelé</h1>
    <div class="row">
        <div class="col-md-12 col-12">
        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Jméno</th>
                <th scope="col">Email</th>
                <th scope="col">Reg Číslo</th>
                <th scope="col">Je admin?</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->reg_number }}</td>
                        <td>{{ $user->is_admin }}</td>
                        <td><button class="btn btn-primary" type="button" onclick="hehe();">admin</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <input class="getinfo"></input>
    <button class="postbutton">Post via ajax!</button>
    <div class="writeinfo"></div>   
</div>
<script>
    console.log($('meta[name="csrf-token"]').attr('content'));
</script>
<script>
    function hehe(){
        $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
  
});
        $.ajax({
            type: "POST",
            url: '{{ url('/postajax') }}',
            data: { request: "1", _token: '{{csrf_token()}}' },
            success: function (data) {
                console.log(data.msg);
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);

        },
    });
    }

            
    </script>
@endsection
