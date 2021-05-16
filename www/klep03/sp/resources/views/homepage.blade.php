<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kjepii</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            margin: 0px;
            height: 100vh;
            width: 100vw;
            font-family: sans-serif;
        }

        .gray {
            background-color: rgb(201, 201, 201);
        }

        .active {
            background-color: black;
            color: rgb(201, 201, 201);
        }

        .border {
            border: 1px;
            border-style: solid;
        }

        header {
            height: 10%;
            min-height: 100px;
            max-height: 120px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 50px;
        }

        .headerSubElement {
            width: 33%;
            display: flex;
        }

        #headerLeft {
            justify-content: flex-start;
            font-size: 22px;

        }

        #headerMid {
            justify-content: center;
            font-size: 40px;
        }

        #headerRight {
            justify-content: flex-end;
            font-size: 22px;
        }

        #divLogout {
            padding: 8px;
        }

        #divSignup {
            padding: 8px;
            margin-right: 20px;
        }

        .hoverable:hover {
            background-color: rgb(163, 163, 163);
            color: black;
        }

        #mid {
            display: flex;
            flex-direction: row;
            height: 90%;
            width: 100%;
        }

        aside {
            width: 15%;
            height: 100%;
        }

        .leftAsideItem {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50px;
            border-bottom-style: solid;
            border-width: 1px;
            font-size: 20px;
        }

        main {
            width: 70%;
            height: 100%;
            padding: 0 20px;
            overflow: scroll;
            border-bottom-style: solid;
            border-width: 1px;
        }

        .noTopBorder {
            border-top-style: none;
        }

        #searchDiv {
            display: flex;
            align-items: center;
        }

        #searchTextArea {
            resize: none;
            font-family: inherit;
            font-size: inherit;
            height: 23px;
        }

        #search {
            margin-left: 5px;
        }

        .innerAreaButton {
            padding: 8px;
            background-color: black;
            color: white;
        }

        .innerAreaButton:hover {
            padding: 8px;
            background-color: rgb(204, 204, 204);
            color: black;
        }

        a {
            color: inherit;
            text-decoration: none;
        }
    </style>
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