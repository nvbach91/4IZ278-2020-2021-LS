<?php
interface DatabaseOperations {
    public function fetch();
    public function create($data);
    public function save();
    public function delete();
}
?>