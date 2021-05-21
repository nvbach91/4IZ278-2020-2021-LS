<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kjepii</title>
    <link rel="stylesheet" href="/css/app.css">
</head>

<body>
    <header class="gray border">
        <div id="headerLeft" class="headerSubElement">{{$LoggedUser}}</div>
        <div id="headerMid" class="headerSubElement"><a href="/">MySongs</a></div>
        <div id="headerRight" class="headerSubElement">
            <div id="divSignup" class="active hoverable">{{$Button1}}</div>
            <div id="divLogout" class="active hoverable">{{$Button2}}</div>
        </div>
    </header>
    <div id="mid">
        <aside class="gray border noTopBorder">
            @foreach ($asideItems as $key => $value)
            <a href="<?= $value ?>">
            <div class="leftAsideItem hoverable">{{ $key }}</div>
        </a>
        @endforeach
        </aside>
        <main>
            <h1>Welcome!</h1>
            <div class="content">
                <p>
                    MySongs is the world biggest database with song lyrics & chords. Yes, that's true. No need to look
                    it
                    up.
                </p>
                <p>
                    You can start by signing up, signing in or start searching for your desired song right away!
                </p>
                <div id="searchDiv">
                    <textarea id="searchTextArea"></textarea>
                    <a href="/search"><div id="search" class="innerAreaButton">Search</div></a> 
                </div>
            </div>
        </main>
        <aside class="gray border noTopBorder"></aside>
    </div>
</body>

</html>