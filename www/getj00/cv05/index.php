
<?php

interface DBOps{
    public function create($args);
    public function read($args);
    public function update($args);
    public function delete($args);    
}


abstract class DB implements DBOps{
    protected $dbExt = ".csv";
    //protected $name = "gesel";
    protected $delim = ";";

    public function __construct(){
        echo " ~~~ ", static::class, " instantiated ~~~ <br>";
    }
    
    public function __toString(){
        return "Extension: $this->dbExt, Delimiter: $this->delim <br>";
    }
    
    public function configInfo(){
        echo $this;
    }
    /*
    public function create($args);
    public function read($args);
    public function update($args);
    public function delete($args);
    */
    
}

// DB object names are in Czech from previous course.
// The app will be in Czech anyway as it'll be used mainly by fellow Czechs.

// As it seems, assuming the args structure is maintained, there's no need for
// defining individual classes for each table. CSV on top.
class Koren extends DB{
    public function create($args){
        echo implode($args, $this->delim), PHP_EOL, '<br>';
    }
    public function read($args){
        echo 'Root was read.<br>';
    }
    public function update($args){
        echo 'Root was updated.<br>';
    }
    public function delete($args){
        echo 'Root was deleted.<br>';
    }
}

class Puvod extends DB{
    public function create($args){
        echo implode($args, $this->delim), PHP_EOL, '<br>';
    }
    public function read($args){
        echo 'Origin was read.<br>';
    }
    public function update($args){
        echo 'Origin was updated.<br>';
    }
    public function delete($args){
        echo 'Origin was deleted.<br>';
    }
}

class Preklad extends DB{
    public function create($args){
        echo implode($args, $this->delim), PHP_EOL, '<br>';
    }
    public function read($args){
        echo 'Translation was read.<br>';
    }
    public function update($args){
        echo 'Translation was updated.<br>';
    }
    public function delete($args){
        echo 'Translation was deleted.<br>';
    }
}

class Odvozenina extends DB{
    public function create($args){
        echo implode($args, $this->delim), PHP_EOL, '<br>';
    }
    public function read($args){
        echo 'Derivative was read.<br>';
    }
    public function update($args){
        echo 'Derivative was updated.<br>';
    }
    public function delete($args){
        echo 'Derivative was deleted.<br>';
    }
}

class Slozenina extends DB{
    public function create($args){
        echo implode($args, $this->delim), PHP_EOL, '<br>';
    }
    public function read($args){
        echo 'Idiomatic compound was read.<br>';
    }
    public function update($args){
        echo 'Idiomatic compound was updated.<br>';
    }
    public function delete($args){
        echo 'Idiomatic compound was deleted.<br>';
    }
}


?>


<?php include '_header.php'; ?>

<?php

$koren = new Koren();
$koren->configInfo();
echo PHP_EOL;
$koren->create(['souhlasky' => 'hmr', 'souprava' => 'S', 'delka' => 3]);
$koren->create(['souhlasky' => 'ktn', 'souprava' => 'J', 'delka' => 3]);
$koren->read(null);
$koren->update(null);
$koren->delete(null);
echo PHP_EOL;

$puvod = new Puvod();
$puvod->create(['jazyk' => 'arb', 'slovo' => '', 'prepis' => 'ahmar']);
$puvod->create(['jazyk' => 'jpn', 'slovo' => '刀', 'prepis' => 'katana']);
$puvod->read(null);
$puvod->update(null);
$puvod->delete(null);
echo PHP_EOL;

$preklad = new Preklad();
$preklad->configInfo();
echo PHP_EOL, $preklad, PHP_EOL;
// radek is supposed to auto increment. May induce duplicate problems, 
// however the last 4 fields can be null, so they cannot be used as a key.
$preklad->create(['radek' => 0, 'jazyk' => 'ces', 
        'podstatne' => 'červeň', 'pridavne' => 'červená', 
        'sloveso' => 'červenat', 'prislovce' => 'červeně']);
$preklad->create(['radek' => 0, 'jazyk' => 'ces', 
        'podstatne' => 'meč', 'pridavne' => 'ostrý', 
        'sloveso' => 'vyrábět meče', 'prislovce' => 'ostře']);
$preklad->read(null);
$preklad->update(null);
$preklad->delete(null);

$odvozenina = new Odvozenina(); // Also Specialni (no Koren reference). No rights for creating views.
$odvozenina->create(['tvar' => 'tobar', 'jazyk' => 'ces', 'vyznam' => 'slaný', 'souhlasky' => 'tbr', 'souprava' => 'J']);
$odvozenina->create(['tvar' => 'tobir', 'jazyk' => 'ces', 'vyznam' => 'sladký', 'souhlasky' => 'tbr', 'souprava' => 'J']);
$odvozenina->read(null);
$odvozenina->update(null);
$odvozenina->delete(null);
echo PHP_EOL;

$slozenina = new Slozenina(); // Also Idiom. No rights for creating synonyms (view as select * in MySQL).
$slozenina->create(['vyraz' => 'al xabat - la xagat.' , 'jazyk' => 'ces', 'vyznam' => 'O sobotě se nepracuje.']);
$slozenina->create(['vyraz' => 'al xabat - la xagat.' , 'jazyk' => 'eng', 'vyznam' => 'No work on Saturdays.']);
$slozenina->create(['vyraz' => 'katan-sakan' , 'jazyk' => 'ces', 'vyznam' => 'mečoun']);
$slozenina->read(null);
$slozenina->update(null);
$slozenina->delete(null);

// Strictly interlinking tables are Antosynonymum, VstupSlovniku, and Pouziti

?>

<?php include '_footer.php'; ?>


