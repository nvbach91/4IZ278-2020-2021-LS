<?php include '../include/_header.php'; ?>

<?php
    require '../include/_scriptData.php';
?>

<h1>Převodník písem</h1>
<br>

<div align="center">
    <label for="Pismo" class="form-label">Zdrojové písmo:</label>
    <select name="script" id="Script" class="select select-initialized form-control">
        <?php
            foreach($scriptNames as $curScriptName){
                echo "<option value=\"$curScriptName\">$curScriptName</option>";
            }
        ?>   
    </select>
    
    <!--
    <?php
        foreach($scriptNames as $curScriptName){
            echo "<input class=\"form-check-input\" type=\"radio\" name=\"script\" id=\"$curScriptName\" value=\"$curScriptName\" />";
            echo "<label class=\"form-check-label\" for=\"$curScriptName\">$curScriptName</label>";
        }
    ?>
    -->
</div>
<br>
<div align="center">
    <label for="SourceText" class="form-label">Zdrojový text:</label>
    <input name="sourceText" type="text" value="" size="128" class="form-control" id="SourceText" onkeyup="convertDebounced()">
</div>
<br>
<div align="center">
    Máte-li vypnutý nebo nefuknční JavaScript, použijte <code>scriptConverterServer.php?script=<i>{vybrané_písmo}</i>&text=<i>{text_k_převedení}</i></code>.
</div>
<br><br><br>
<div id="ConvertedText" align="center"></div>
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

    function convert(){
        if (text.length == 0) {
            document.getElementById("ConvertedText").innerHTML = "<h2>... čeká se na vstup ...</h2>";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("ConvertedText").innerHTML = this.responseText;
                }
            };
            var script = document.querySelector('select[name="script"]');
            //var script = document.querySelector('input[name="script"]:checked');
            var text = document.querySelector('input[name="sourceText"]').value;
            xmlhttp.open("GET", "/~getj00/sp/tools/scriptConverterServer.php?script=" + (script != null ? script.value : "latin") + "&text=" + text, true);
            xmlhttp.send();
        }
    }
    
    const convertDebounced = debounce(() => convert());

//-->

</script>


<?php include '../include/_footer.php'; ?>

