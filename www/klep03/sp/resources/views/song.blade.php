<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kjepii</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300&display=swap');

        body {
            display: flex;
            flex-direction: column;
            margin: 0px;
            height: 100vh;
            width: 100vw;
            font-family: 'Noto Sans TC', sans-serif;
            border-color: black;
            color: rgb(218, 197, 17);

        }

        .gray {
            background-color: rgb(61, 61, 61);
        }

        .active {
            background-color: black;
            color: rgb(201, 201, 201);
        }

        .border {
            border: 1px;
            border-style: solid;
            border-color: black;
        }

        header {
            height: 10%;
            min-height: 100px;
            max-height: 120px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 50px;
            border-color: black;
            background-color: rgb(36, 36, 36);
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
            background-color: rgb(75, 75, 75);
            color: rgb(218, 197, 17);
        }

        #mid {
            display: flex;
            flex-direction: row;
            height: 90%;
            width: 100%;
            border-color: black;
        }

        aside {
            width: 15%;
            height: 100%;
            border-color: black;
        }

        .leftAsideItem {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50px;
            border-bottom-style: solid;
            border-width: 1px;
            font-size: 20px;
            border-color: black;
        }

        main {
            width: 70%;
            height: 100%;
            padding: 0 20px;
            overflow: scroll;
            border-bottom-style: solid;
            border-width: 1px;
            color: black;
            background-color: rgb(250, 247, 242);
        }

        .noTopBorder {
            border-top-style: none;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

    </style>
</head>

<body>
    <header class="border">
        <div id="headerLeft" class="headerSubElement">{{ $LoggedUser }}</div>
        <div id="headerMid" class="headerSubElement"><a href="/">MySongs</a></div>
        <div id="headerRight" class="headerSubElement">
            <div id="divSignup" class="active hoverable">{{ $Button1 }}</div>
            <div id="divLogout" class="active hoverable">{{ $Button2 }}</div>
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
            @foreach ($songArray as $song)
            <h1>{{ $song->name }} – {{ $song->artist }}</h1>
            <div class="users">
                <pre><?php echo $song->lyrics_w_chords ?></pre>
            </div>
            @endforeach
        </main>
        <aside class="gray border noTopBorder"></aside>
    </div>
</body>

</html>
