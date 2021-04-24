<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Flashcards</title>
</head>
<body class="bg-gray-900">
<div class="app-container">
    @if ($errors->any())
        <div class="bg-red-500">
            <div class="container mx-auto py-5 flex flex-col">
                <h1 class="font-bold uppercase text-sm text-red-300">There were some errors with the request</h1>
                <div class="flex flex-col mt-2 text-white text-lg font-bold">
                    @foreach($errors->all() as $error)
                        <div>
                            <span class="text-red-300 mr-2">&ndash;</span>
                            {{ $error }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    @yield("app")
</div>
<script src="https://kit.fontawesome.com/926e679c11.js" crossorigin="anonymous"></script>
<script src="/js/favorites.js"></script>
</body>
</html>
