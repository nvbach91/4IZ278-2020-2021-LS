<div class="d-flex flex-column align-items-center">
    @if(session()->has('error'))
        <div class="w-50 text-center alert alert-danger">
            <p class="mb-0">{{session()->get('error')}}</p>
        </div>
    @endif

    @if(session()->has('success'))
        <div class="w-50 text-center alert alert-success">
            <p class="mb-0">{{session()->get('success')}}</p>
        </div>
    @endif
</div>
