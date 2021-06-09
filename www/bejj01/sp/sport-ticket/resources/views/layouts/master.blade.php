<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
</head>
<body class="antialiased bg-light">
    @include('includes.navbar')
    <div class="pointer top-button justify-content-center align-items-center" onclick="topFunction()" id="top-button"><i class="fas fa-chevron-up"></i></div>
        @yield('content')
    @include('includes.footer')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js"></script>
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>
