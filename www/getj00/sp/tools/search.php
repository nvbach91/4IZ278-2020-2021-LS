<?php include '../include/_header.php'; ?>


<h1>Vyhledávání</h1>
<br>

<div align="center">
    <label for="Pismo" class="form-label">Hledat v:</label>

    <input class="form-check-input" type="radio" name="queryLang" id="Gesel" value="gesel" />
    <label class="form-check-label" for="Gesel">GeSeLu</label>
    <input class="form-check-input" type="radio" name="queryLang" id="Origin" value="origin" />
    <label class="form-check-label" for="Origin">zdrojových jazycích</label>
    <input class="form-check-input" type="radio" name="queryLang" id="Transl" value="transl" />
    <label class="form-check-label" for="Transl">překladových jazycích</label>

</div>
<br>
<div align="center">
    <label for="Query" class="form-label">Hledaný výraz:</label>
    <input name="query" type="text" value="" size="128" class="form-control" id="Query" onkeyup="search(this.value)">
</div>
<br>
<div align="center">
    Máte-li vypnutý nebo nefuknční JavaScript, použijte <code>searchServer.php?queryLang=<i>{gesel|origin|transl}</i>&query=<i>{hledaný_výraz}</i></code>.
</div>
<br><br><br>
<div id="Results" align="center"></div>
<br><br><br>


<script language="javascript">
<!--
    // https://www.freecodecamp.org/news/javascript-debounce-example/
    function debounce(func, timeout = 250){
        let timer;
        return (...args) => {
            clearTimeout(timer);
            timer = setTimeout(() => { func.apply(this, args); }, timeout);
        };
    }

    function search(text){
        if (text.length == 0) {
            document.getElementById("Results").innerHTML = "<h2>... čeká se na vstup ...</h2>";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("Results").innerHTML = this.responseText;
                }
            };
            var ql = document.querySelector('input[name="queryLang"]:checked');
            //var text = document.querySelector('input[name="query"]').value;
            xmlhttp.open("GET", "https://eso.vse.cz/~getj00/sp/tools/searchServer.php?queryLang=" + (ql != null ? ql.value : "gesel") + "&query=" + text, true);
            xmlhttp.send();
        }
    }
    
    const searchDebounced = debounce(() => search());

//-->

</script>

<?php include "../include/_mainMenu.php"; ?>

<?php include '../include/_footer.php'; ?>
