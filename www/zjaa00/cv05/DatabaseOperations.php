<?php
interface DatabaseOperations {
    public function fetch(int $id);
    public function create(array $args);
    public function save(int $id, array $args);
    public function delete(int $id);
}