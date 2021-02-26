<?php

class Dog{
        
    public function __construct( $type, $gender, $weight, $height)
    {
        $this->type = $type;
        $this->gender = $gender;
        $this->weight = $weight;
        $this->height = $height;
        
    }

    public function getDimension(){
        return "Weight: $this->weight, Height: $this->height";
    }
}
?>