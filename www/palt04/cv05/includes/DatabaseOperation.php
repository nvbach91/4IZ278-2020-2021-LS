<?php

interface DatabaseOperation {
    public function create($args);
    public function fetch($args);
    public function update($args);
    public function delete($args);
}
?>
