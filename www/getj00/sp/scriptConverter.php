<?php include '_header.php'; ?>

<?php
    require '_scriptData.php';
?>

<h1>Převodník písem</h1>
<br>

<div>
    <label for="Pismo" class="form-label">Zdrojové písmo:</label>
    <?php
        foreach($scriptNames as $curScriptName){
            echo "<input class=\"form-check-input\" type=\"radio\" name=\"script\" id=\"$curScriptName\" value=\"$curScriptName\" />";
            echo "<label class=\"form-check-label\" for=\"$curScriptName\">$curScriptName</label>";
        }
    ?>
</div>
<br>
<div>
    <label for="SourceText" class="form-label">Zdrojový text:</label>
    <input name="sourceText" type="text" value="" size="128" class="form-control" id="SourceText" onkeyup="convert(this.value)">
</div>
<br><br><br>
<div id="ConvertedText"></div>
<br><br><br>


<script language="javascript">
<!--
    function convert(text){
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
            var script = document.querySelector('input[name="script"]:checked');
            xmlhttp.open("GET", "/~getj00/scriptConverterServer.php?script=" + (script != null ? script.value : "latin") + "&text=" + text, true);
            xmlhttp.send();
        }
    }

//-->

</script>


<?php include '_footer.php'; ?>

