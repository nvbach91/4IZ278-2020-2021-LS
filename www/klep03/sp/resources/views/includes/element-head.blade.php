<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="/css/app.css">
</head>

<body>
    <header class="gray border">
        <div id="headerLeft" class="headerSubElement">User: {{ $pageItems['loggedUser'] }}</div>
        <div id="headerMid" class="headerSubElement"><a href="/">MySongs</a></div>
        <div id="headerRight" class="headerSubElement">
            <a href="<?= $pageItems['button1']['href'] ?>"><div id="divButton1" class="active hoverable">{{ $pageItems['button1']['label'] }}</div></a>
            <a href="<?= $pageItems['button2']['href'] ?>"><div id="divButton2" class="active hoverable">{{ $pageItems['button2']['label'] }}</div></a>
        </div>
    </header>
    <div id="mid">
        <aside class="gray border noTopBorder">
            @foreach ($pageItems['asideItems'] as $key => $value)
                <a href="<?= $value ?>">
            <div class="leftAsideItem hoverable">{{ $key }}</div>
        </a>
        @endforeach
        </aside>
        <main>