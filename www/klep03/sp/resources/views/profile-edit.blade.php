@include('includes.element-head')
<form id="profile-edit" action="/profile/edit/submit" method="post">
    @csrf
    <h1>Name: <textarea name="name">{{ $user->name }}</textarea></h1>
    Email: {{ $user->email }}
    <div class="customProfileText">
        <h3>User info</h3>
        <textarea name="userInfo">{{ $user->user_info }}</textarea>
    </div>
    <div class="customProfileText">
        <h3>User Instruments</h3>
        <textarea name="instruments">{{ $user->instruments }}</textarea>
    </div>
    <div class="divForButton"><button type="submit" class="btn btn-primary">Save</button></div>
</form>
@include('includes.element-foot')
