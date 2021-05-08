
<?php include '_header.php'; ?>

<!--
Nový vstup slovníku:
Souhlásky Sada (Délka) Jazyk1 Slovo Přepis Jazyk2 Podstatné Přídavné Sloveso Příslovce

Nový vstup thesauru (Vztah - A/S/V):
Souhlásky Sada Vztah Souhlásky Sada

Nový vstup idiomu/složeniny:
Idiom Jazyk Význam (Kořeny - dymamický návrh)

Nová odvozenina/speciální:
(Kořen Sada - dynamický návrh) Tvar Jazyk Význam

- Vyhledávání
- Zobrazení 4 věcí výše (původně VIEW)
- Statistiky
- Kontaktní sekce pro DMCA apod.

Bonus:
- Test na slovíčka a/nebo gramatiku, lingvistická olympiáda
- Anotace textu, nápověda k překladu - odkaz na kořeny, mluvnické kategorie
- Matematika - bázová aritmetika, modální predikátová logika, algoritmy, SCIO
- LSDračí doupě, daišógi, pexeso
- převodník písem


-->

<h1>~~~ GeSeLátor ~~~</h1>

<p align="center">
    Vkládání by mohlo fungovat, ale taky může rozhašit DB. Opatrně.
</p>

<div class="menu">

<h3>Vložit:</h3>
<ul> <!-- Po úspěchu přesměrují na odpovídající zobrazit -->
    <li><a href="insertDictEntry.php">Vstup kořenovníku</a></li>
    <li><a href="insertThesaurus.php">Vazbu thesauru</a></li>
    <li><a href="insertIdiom.php">Použití kořenu v idiomu či složenině</a></li>
    <li><a href="insertDeriv.php">Odvozeninu nebo speciální slovo</a></li>
</ul>
<br>
<h3>Zobrazit:</h3>
<ul> <!-- Může trvat dlouho načíst - filtr dle soupravy, délky a jazyků? -->
    <li><a href="viewDictEntry.php">Kořenovník</a></li>
    <li><a href="viewThesaurus.php">Thesaurus</a></li>
    <li><a href="viewIdiom.php">Idiomy a složeniny</a></li>
    <li><a href="viewDeriv.php">Odvozeniny a speciální slova</a></li>
</ul>
<br>
<h3>Nástroje:</h3>
<ul>
    <li><a href="search.php">Vyhledávání</a></li> <!-- Detailnější než filtry -->
    <li><a href="scriptConverter.php">Převodník písem</a></li>
    <li><a href="#">Test na slovíčka</a></li>
    <li><a href="#">Test z aritmetiky a logiky</a></li>
</ul>
<br>
<h3>Meta:</h3>
<ul>
    <li><a href="stats.php">Statistiky</a></li>
    <li><a href="about.php">O GeSeLu a GeSeLátoru</a></li>
    <li><a href="contact.php">Kontakty na správce</a></li>
</ul>
</div>

<?php include '_footer.php'; ?>


