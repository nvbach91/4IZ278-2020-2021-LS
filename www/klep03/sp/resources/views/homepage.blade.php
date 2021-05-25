@include('includes.element-head')
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
    <div>
        <h2>Results:</h2>
    </div>
    <div id="results">
        <?php if (isset($results)) {
        foreach ($results as $result) {
        echo "<a href=\"/songs/$result->id\">";
            echo "<div class=\"searchResult\">$result->artist – $result->name</div>";
            echo '</a>';
        }
        } ?>
    </div>
</div>

<script>
    let textarea = document.querySelector('#searchTextArea');

    function redirect() {
        console.log('kliknuto');
        window.location.href = '/search/' + textarea.value;
    };
    document.querySelector('#search').addEventListener('click', redirect);
    document.addEventListener('keydown', function(e) {
        if (e.code === "Enter") {
            // console.log(e.code);
            redirect();
        }
    });

</script>

@include('includes.element-foot')
