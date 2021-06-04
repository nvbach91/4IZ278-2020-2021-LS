@include('includes.element-head')
<form id="signInForm" class="signForm" action="<?= $pageItems['urlPrefix'] ?>/email-confirmation/submit" method="POST">
    <h1>Confirm your e-mail with your activation code!</h1>
    @csrf


    @if (!isset($status) or $status == 'fail')
        <div class="mb-3" style="margin-top: 20px;">
            <label for="exampleInputEmail1" class="form-label">Activation code from your e-mail:</label>
            <input name="activationCode" class="form-control" id="activationCode">
        </div>
        <button type="submit" class="btn btn-primary">Confirm e-mail address</button>
        @if ($status == 'fail')
            <p class="redText">The code you provided is incorrect.</p>
        @endif
    @else
        <p>Your account has been activated!</p>
    @endif

    
</form>
@include('includes.element-foot')
