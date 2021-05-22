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
                    <div id="search" class="innerAreaButton" rows="1">Search</div>
                </div>
                <div id="results">
                    <?php if (isset($results)) {
                        foreach ($results as $result) {
                            echo "<div>$result->name</div>";
                        }
                    } ?>
                </div>
            </div>
        </main>
        <aside class="gray border noTopBorder"></aside>
    </div>
    <script>
        let textarea = document.querySelector('#searchTextArea');
        function redirect() {
            console.log('kliknuto');
            window.location.href = '/search/' + textarea.value;
        };
        document.querySelector('#search').addEventListener('click', redirect);
        // document.addEventListener('keydown', checkKey);
        </script>
</body>

</html>
