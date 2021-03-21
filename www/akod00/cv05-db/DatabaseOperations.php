<?php

  interface DatabaseOperations
  {
    public function fetch();
    public function create($entity);
    public function save();
    public function delete($entity);
  }