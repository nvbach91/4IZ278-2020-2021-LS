
<?php

// AJAX SERVER SIDE
require '../include/_dbConnect.php';

$queryLang = $_GET['queryLang'];
$query = htmlspecialchars($_GET['query']);

$searchKoren = "select * from Koren where souhlasky like '%:cons%'";
$searchPuvod = "select * from Puvod where prepis like '%:transc%' or slovo like '%:orig%'";
$searchPreklad = "select * from Preklad where podstatne like '%:subst%' or pridavne like '%:adj%' or sloveso like %:verb% or prislovce like '%:adv%'";
$searchOdvozenina = "select * from Odvozenina where tvar like '%:form' or vyznam like '%:mean%'";
$searchIdiom = "select * from Idiom where tvar like '%:form' or vyznam like '%:mean'";

echo '<table><thead><td>Písmo</td><td>Text</td></thead>';

if($query){

/*
GeSeL -> extract consonants, search in Koren; search in Odvozenina; search in Pouziti/Idiom
origin -> search in Puvod
transl -> search in Preklad; search in Odvozenina; search in Idiom

On top of that, build annotation - search for each word, extract root / match patterns.

*/

    if($queryLang != "origin"){
        // Odvozenina
        
        // Idiom
    }

    if($queryLang == "origin"){
        // Puvod
    }

    if($queryLang == "transl"){
        // Preklad
    }

/*
        echo "<tr><td>$curScriptName</td><td>";
        foreach(utf8_str_split($sourceText) as $curChar) {
            $curCharIndex = array_search($curChar, $scripts[$sourceScriptName]);
            echo $scripts[$curScriptName][$curCharIndex];        
        }
        echo "</td></tr>";
*/        
}
echo '</table>';

?>
