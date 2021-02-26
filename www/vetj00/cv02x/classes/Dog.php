<?php 

class Dog {

    public function __construct($type, $gender, $weight, $height){
        $this->type = $type;
        $this->gender = $gender;
        $this->weight = $weight;
        $this->height = $height;
    }

    public function getDimensions(){
        return "Height $this->height, weight $this->weight";
    }

}

?>