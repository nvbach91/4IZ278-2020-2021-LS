
<?php

class City {
    public function __construct($name, $population, $area) {
        $this->name = $name;
        $this->population = $population;
        $this->area = $area;
    }

    public function getAreaInMeterSquare() {
        return "$this->area m2";
    }

}

?>
