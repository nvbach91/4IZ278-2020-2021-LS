<?php 

interface DatabaseOperations {
    public function fetchAll();
    public function fetchBy($field, $value);
    public function deleteBy($field, $value);
}

?>