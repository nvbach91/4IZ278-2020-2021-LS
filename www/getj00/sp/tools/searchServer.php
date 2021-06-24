
<?php

// AJAX SERVER SIDE
require '../include/_dbConnect.php';

$queryLang = $_GET['queryLang'];
$query = htmlspecialchars($_GET['query']);

$searchKoren = $pdo->prepare("select * from Koren where souhlasky like '%:cons%'");
$searchPuvod = $pdo->prepare("select * from Puvod where prepis like '%:transc%' or slovo like '%:orig%'");
$searchPreklad = $pdo->prepare("select * from Preklad where podstatne like '%:subst%' or pridavne like '%:adj%' or sloveso like %:verb% or prislovce like '%:adv%'");
$searchOdvozenina = $pdo->prepare("select * from Odvozenina where tvar like '%:form' or vyznam like '%:mean%'");
$searchIdiom = $pdo->prepare("select * from Idiom where tvar like '%:form' or vyznam like '%:mean'");

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
        $searchOdvozenina->execute(['form' => $query, 'mean' => $query]);
        foreach($searchOdvozenina->fetchAll() as $row){
            print_r($row);
        }
        echo '<br>';
        
        // Idiom
        $searchIdiom->execute(['form' => $query, 'mean' => $query]);
        foreach($searchIdiom->fetchAll() as $row){
            print_r($row);
        }
        echo '<br>';
    }

    if($queryLang == "origin"){
        // Puvod
        $searchPuvod->execute(['transc' => $query, 'orig' => $query]);
        foreach($searchPuvod->fetchAll() as $row){
            print_r($row);
        }
        echo '<br>';
    }

    if($queryLang == "transl"){
        // Preklad
        $searchPuvod->execute(['subst' => $query, 'adj' => $query, 'verb' => $query, 'adv' => $query]);
        foreach($searchPuvod->fetchAll() as $row){
            print_r($row);
        }
        echo '<br>';
    }
    
    if($queryLang == "gesel"){
        // Preklad
        $vowels = array("a", "e", "i", "o", "u");
        $onlycons = str_replace($vowels, "", strtolower($query));
        $searchKoren->execute(['cons' => $onlycons]);
        foreach($searchPuvod->fetchAll() as $row){
            print_r($row);
        }
        echo '<br>';
    }
       
}
echo '</table>';

?>
