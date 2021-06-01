@include('includes.element-head')



<form id="signUpForm" class="signForm" action="<?= $pageItems['urlPrefix'] ?>/signup/submit" method="POST">
    <h1>Sign Up!</h1>
    @csrf
    {{-- @if ($errors->any())
    <div>
       @foreach ($errors->all() as $error)
          <div class="redText">{{$error}}</div> 
       @endforeach 
    </div>
    @endif --}}
    <div class="mb-3" style="margin-top: 20px;">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="signUpEmail" name="email" aria-describedby="emailHelp" value="{{ old('email') }}">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        @error('email')
              <div class="redText">{{ $message }}</div>  
        @enderror
        <?php if (isset($customErrorMessage)) {
            echo "<div class=\"redText\">The email you provided already exists. </div>";
        } ?>
    </div>

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
        @error('password')
              <div class="redText">{{ $message }}</div>  
        @enderror
    </div>

    <label for="inputPassword5" class="form-label">Repeat password</label>
    <input type="password" id="inputPassword5" name="confirmPassword" class="form-control" aria-describedby="passwordHelpBlock">
        @error('confirmPassword')
              <div class="redText">{{ $message }}</div>  
        @enderror
    <div id="passwordHelpBlock" class="form-text">
        Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special
        characters, or emoji.
    </div>
    <button type="submit" class="btn btn-primary buttonTopMargin">Signup</button>
</form>

@include('includes.element-foot')
