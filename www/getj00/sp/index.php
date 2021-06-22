
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>GeSeLátor - Hlavní menu</title>
	<!-- Musí být specifikována cesta bez .. -->
	<link rel="stylesheet" type="text/css" href="include/style.css" />
</head>
<body>

<!--
TODO:
- Vyhledávání
- Kontaktní sekce pro DMCA apod.

Bonus:
- Test na slovíčka a/nebo gramatiku, lingvistická olympiáda
- Anotace textu, nápověda k překladu - odkaz na kořeny, mluvnické kategorie
- Matematika - bázová aritmetika, modální predikátová logika, algoritmy, SCIO
- LSDračí doupě, daišógi, pexeso
- uživatelské účty pro žebříčky

-->

<h1>~~~ GeSeLátor ~~~</h1>

<p align="center">
    Pracuje se na vyhledávání, inšalláh bude i anotace.
</p>

<div class="menu">

<h3>Vložit:</h3>
<ul> <!-- Po úspěchu přesměrují na odpovídající zobrazit -->
    <li><a href="db/insertDictEntry.php">Vstup kořenovníku</a></li>
    <li><a href="db/insertThesaurus.php">Vazbu thesauru</a></li>
    <li><a href="db/insertIdiom.php">Použití kořenu v idiomu či složenině</a></li>
    <li><a href="db/insertDeriv.php">Odvozeninu nebo speciální slovo</a></li>
</ul>
<br>
<h3>Zobrazit:</h3>
<ul> <!-- Může trvat dlouho načíst - filtr dle soupravy, délky a jazyků? -->
    <li><a href="db/viewDictEntry.php">Kořenovník</a></li>
    <li><a href="db/viewThesaurus.php">Thesaurus</a></li>
    <li><a href="db/viewIdiom.php">Idiomy a složeniny</a></li>
    <li><a href="db/viewDeriv.php">Odvozeniny a speciální slova</a></li>
</ul>
<br>
<h3>Nástroje:</h3>
<ul>
    <li><a href="tools/search.php">Vyhledávání</a></li> <!-- Detailnější než filtry -->
    <li><a href="tools/scriptConverter.php">Převodník písem</a></li>
    <li><a href="#">Test na slovíčka</a></li>
    <li><a href="#">Test z aritmetiky a logiky</a></li>
</ul>
<br>
<h3>Meta:</h3>
<ul>
    <li><a href="meta/stats.php">Statistiky</a></li>
    <li><a href="meta/about.php">O GeSeLu a GeSeLátoru</a></li>
    <li><a href="meta/contact.php">Kontakty na správce</a></li>
</ul>
</div>

<?php include 'include/_footer.php'; ?>


