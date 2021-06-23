<?php 

    interface DatabaseOperations {
        public function fetchAll();
        public function fetchBy($field, $value);
        public function create($args);
        public function updateBy($conditions, $args);
    }

?>