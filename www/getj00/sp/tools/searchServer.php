
<?php

// AJAX SERVER SIDE
require '../include/_dbConnect.php';


class DBSearch extends DBConnection{

    private $searchKoren;
    private $searchPuvod;
    private $searchPreklad;
    private $searchOdvozenina;
    private $searchSlozenina;

    public function __construct(){
        parent::__construct();
        $this->searchKoren = $this->pdo->prepare("select * from Koren where souhlasky like :cons");
        $this->searchPuvod = $this->pdo->prepare("select * from Puvod where prepis like :transc or slovo like :orig");
        $this->searchPreklad = $this->pdo->prepare("select * from Preklad where podstatne like :subst or pridavne like :adj or sloveso like :verb or prislovce like :adv");
        $this->searchOdvozenina = $this->pdo->prepare("select * from Odvozenina where tvar like :form or vyznam like :mean");
        $this->searchIdiom = $this->pdo->prepare("select * from Slozenina where vyraz like :form or vyznam like :mean");
    }

    public function getSearchKoren(){
        return $this->searchKoren;
    }
    public function getSearchPuvod(){
        return $this->searchPuvod;
    }
    public function getSearchPreklad(){
        return $this->searchPreklad;
    }
    public function getSearchOdvozenina(){
        return $this->searchOdvozenina;
    }
    public function getSearchSlozenina(){
        return $this->searchSlozenina;
    }
    

}

function wild($str){
    return '%' . $str . '%';
}

$queryLang = $_GET['queryLang'];
$query = htmlspecialchars($_GET['query']);




if($query){

/*
GeSeL -> extract consonants, search in Koren; search in Odvozenina; search in Pouziti/Idiom
origin -> search in Puvod
transl -> search in Preklad; search in Odvozenina; search in Idiom

On top of that, build annotation - search for each word, extract root / match patterns.

*/

$dbSearch = new DBSearch();
$wq = wild($query);

    if($queryLang != "origin"){
        // Odvozenina
        $dbSearch->executeQuery($dbSearch->getSearchOdvozenina(), ['form' => $wq, 'mean' => $wq]);
        foreach($dbSearch->fetchResults($dbSearch->getSearchOdvozenina()) as $row){
            print_r($row);
        }
        echo '<br>';
        
        // Idiom/Slozenina
        $dbSearch->executeQuery($dbSearch->getSearchSlozenina(), ['form' => $wq, 'mean' => $wq]);
        foreach($dbSearch->fetchResults($dbSearch->getSearchSlozenina()) as $row){
            print_r($row);
        }
        echo '<br>';
    }

    if($queryLang == "origin"){
        // Puvod
        $dbSearch->executeQuery($dbSearch->getSearchPuvod(), ['transc' => $wq, 'orig' => $wq]);
        foreach($dbSearch->fetchResults($dbSearch->getSearchPuvod()) as $row){
            print_r($row);
        }
        echo '<br>';
    }

    if($queryLang == "transl"){
        // Preklad
        $dbSearch->executeQuery($dbSearch->getSearchPreklad(), ['subst' => $wq, 'adj' => $wq, 'verb' => $wq, 'adv' => $wq]);
        foreach($dbSearch->fetchResults($dbSearch->getSearchPreklad()) as $row){
            print_r($row);
        }
        echo '<br>';
    }
    
    if($queryLang == "gesel"){
        // Preklad
        $vowels = array("a", "e", "i", "o", "u");
        $onlycons = str_replace($vowels, "", strtolower($query));
        $dbSearch->executeQuery($dbSearch->getSearchKoren(), (['cons' => wild($onlycons)]);
        foreach($dbSearch->fetchResults($dbSearch->getSearchKoren()) as $row){
            print_r($row);
        }
        echo '<br>';
    }
       
}
echo '</table>';

?>
