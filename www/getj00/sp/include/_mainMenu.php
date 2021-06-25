
<?php
$urlPrefix = "https://eso.vse.cz/~getj00/sp/";
?>
<br><br>
<div class="menu">

<h3>Vložit:</h3>
<ul> <!-- Po úspěchu přesměrují na odpovídající zobrazit -->
    <li><a href="<?php echo $urlPrefix; ?>db/insertDictEntry.php">Vstup kořenovníku</a></li>
    <li><a href="<?php echo $urlPrefix; ?>db/insertThesaurus.php">Vazbu thesauru</a></li>
    <li><a href="<?php echo $urlPrefix; ?>db/insertIdiom.php">Použití kořenu v idiomu či složenině</a></li>
    <li><a href="<?php echo $urlPrefix; ?>db/insertDeriv.php">Odvozeninu nebo speciální slovo</a></li>
</ul>
<br>
<h3>Zobrazit:</h3>
<ul> <!-- Může trvat dlouho načíst - filtr dle soupravy, délky a jazyků? -->
    <li><a href="<?php echo $urlPrefix; ?>db/viewDictEntry.php">Kořenovník</a></li>
    <li><a href="<?php echo $urlPrefix; ?>db/viewThesaurus.php">Thesaurus</a></li>
    <li><a href="<?php echo $urlPrefix; ?>db/viewIdiom.php">Idiomy a složeniny</a></li>
    <li><a href="<?php echo $urlPrefix; ?>db/viewDeriv.php">Odvozeniny a speciální slova</a></li>
</ul>
<br>
<h3>Nástroje:</h3>
<ul>
    <li><a href="<?php echo $urlPrefix; ?>tools/search.php">Vyhledávání</a></li> <!-- Detailnější než filtry -->
    <li><a href="<?php echo $urlPrefix; ?>tools/scriptConverter.php">Převodník písem</a></li>
    <!-- <li><a href="#">Test na slovíčka</a></li> -->
    <!-- <li><a href="#">Test z aritmetiky a logiky</a></li> -->
</ul>
<br>
<h3>Meta:</h3>
<ul>
    <li><a href="<?php echo $urlPrefix; ?>meta/stats.php">Statistiky</a></li>
    <li><a href="<?php echo $urlPrefix; ?>meta/about.php">O GeSeLu a GeSeLátoru</a></li>
    <li><a href="<?php echo $urlPrefix; ?>meta/contact.php">Kontakty na správce</a></li>
</ul>
</div>
<br>
