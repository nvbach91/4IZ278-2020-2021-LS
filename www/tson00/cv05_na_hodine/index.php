
<?php require './includes/header.php'//include pro veci bez php, require once vypisuje jen jednou?>
<?php require './includes/navigation.php'//include pro veci bez php, require once vypisuje jen jednou?>
<?php

class Simple {
    public $prop = 'prop';
}

$simpleInstance = new Simple;
print_r($simpleInstance);
echo gettype($simpleInstance), PHP_EOL;
echo "Am I an instance of Simple? Answer:", $simpleInstance instanceof Simple;

?>
<?php

class Person {
    public $name;
}

$dave = new Person();
$dave->name = "Dave";

$hope = new Person();
$hope->name = "Hope";

echo $dave->name, PHP_EOL;
echo $hope->name, PHP_EOL;

?>
<?php

class Circle {
    public $radius;
    public function setRadius($radius) {
        $this->radius = $radius;
    }
    public function area() {
        return $this->radius * $this->radius * M_PI;
    }
}

$c1 = new Circle();
$c1->setRadius(5);

echo $c1->area();

?>
<?php

/**
 * Dědičnost nám umožňuje krátit redundantní kódy, tj. znova deklarovat co už bylo někde deklarováno
 * 
 * Nemusíme opisovat oběma třídám ty samé atributy, ale stačí dopsat jen to, v čem se liší. Zbytek se podědí.
 * 
 * Můžeme rozšiřovat existující komponenty o nové metody a tím je znovu využívat.
 */
class Base {
    // public members will be inherited
    public $name = "Base";
    // protected members will be inherited
    protected $id = 6124;
    // private WILL NOT be inherited
    private $is_defined = "yes"; 

}

class Derived extends Base {

    public function info() {
        echo "This is Derived class", PHP_EOL;
        echo "Members inherited: ", PHP_EOL;

        echo $this->name, PHP_EOL;
        echo $this->id, PHP_EOL;
        // $is_defined is not inherited since it is private in the base class
        //echo $this->is_defined, PHP_EOL;
    }
}

$derived = new Derived();
$derived->info();

?>
<?php require './includes/footer.php'?> 