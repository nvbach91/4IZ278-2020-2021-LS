<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class SizeDB extends Database {
    protected $tableName = 'SIZE';

    function __construct() {
		parent::__construct();
	}

    function listForSize($sizeId) {
        return $this->find('ID', $sizeId);
    }

    public function getListOfSizes() {
        return $this->list();
    }

    public function getCountOfSizes() {
        return $this->countOf();
    }
}
?> 