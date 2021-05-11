<?php


abstract class Model
{

    public static $objectCache = [];
    
    protected $id;
    protected $attrMap;

    private $empty;

    public function __construct($id)
    {
        $this->id = $id;

        if ($id > -1) {
            $this->empty = true;
            $this->load();
        } else {
            $this->empty = false;
        }
    }

    public function create() {
        if (gettype($this->attrMap) != "array") {
            return false;
        }
        $attrs = array();
        foreach ($this->attrMap as $value) {
            $attrs[$value] = $this->$value;
        }
        $result = Database::getInstance()->insert($this::TABLE_NAME, $attrs);
        if ($result) {
            return true;
        }
        trigger_error("Object " . get_class($this) . " creation failed");
        return false;
    }

    public function update() {
        if (gettype($this->attrMap) != "array") {
            return false;
        }
        $attrs = array();
        foreach ($this->attrMap as $value) {
            $attrs[$value] = $this->$value;
        }

        $result = Database::getInstance()->update($this::TABLE_NAME, $attrs, array('id' => $this->id));
        if ($result) {
            return true;
        }
        trigger_error("Object " . get_class($this) . " update failed");
        return false;
    }

    public function load() {
        if ($this->empty === true) {
            $results = Database::getInstance()->select($this::TABLE_NAME, array('id' => $this->id));
            if ($results != null && count($results) != 0) {
                foreach ($results[0] as $key => $value) {
                    $this->$key = $value;
                }
                $this->empty = false;
                return true;
            }
            trigger_error("Object " . get_class($this) . " load failed");
            return false;
        }
    }

    public function delete() {
        $result = Database::getInstance()->delete($this::TABLE_NAME, array('id' => $this->id));
        unset(self::$objectCache[$this->id]);
        if ($result) {
            return true;
        }
        trigger_error("Object " . get_class($this) . " delete failed");
        return false;
    }

    public function getId() {
        return $this->id;
    }

    public static function getAll() {
        $className = get_called_class();
        $results = Database::getInstance()->selectQ("SELECT id FROM " . $className::TABLE_NAME);
        $objects = array();
        foreach ($results as $result) {
            $objects[] = new $className($result['id']);
        }

        return $objects;
    }

}