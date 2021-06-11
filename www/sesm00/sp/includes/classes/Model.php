<?php


abstract class Model
{

    public static $objectCache;
    
    protected $id;
    protected $attrMap;

    private $loaded;

    public function __construct($id)
    {
        $this->id = $id;
        $this->loaded = false;

    }

    public function create() {
        if ($this->loaded) {
            return true;
        }
        if (gettype($this->attrMap) != "array") {
            return false;
        }
        $attrs = array();
        foreach ($this->attrMap as $value) {
            $attrs[$value] = $this->$value;
        }
        $result = Database::getInstance()->insert($this::TABLE_NAME, $attrs);
        if ($result) {
            $className = get_called_class();
            $this->id = Database::getInstance()->getInsertId();
            $className::$objectCache[$this->id] = $this;
            $this->loaded = true;
            return true;
        }
        trigger_error("Object " . get_class($this) . " creation failed");
        return false;
    }

    public function update() {
        if (!$this->loaded) {
            return false;
        }
        if (gettype($this->attrMap) != "array") {
            return false;
        }
        $attrs = array();
        foreach ($this->attrMap as $value) {
            $attrs[$value] = $this->$value;
        }

        $result = Database::getInstance()->update($this::TABLE_NAME, $attrs, array('id' => $this->id));
        if ($result) {
            $className = get_called_class();
            $className::$objectCache[$this->id] = $this;
            return true;
        }
        trigger_error("Object " . get_class($this) . " update failed");
        return false;
    }

    public function load() {
        if ($this->loaded === false) {
            $className = get_called_class();
            $results = Database::getInstance()->select($this::TABLE_NAME, array('id' => $this->id));
            if ($results != null && count($results) != 0) {
                foreach ($results[0] as $key => $value) {
                    $this->$key = $value;
                }
                $this->loaded = true;
                $className::$objectCache[$this->id] = $this;
                return true;
            }
            trigger_error("Object " . get_class($this) . " load failed");
            return false;
        }
        return true;
    }

    public function delete() {
        $className = get_called_class();
        $result = Database::getInstance()->delete($this::TABLE_NAME, array('id' => $this->id));
        if (isset($className::$objectCache[$this->id])) {
            unset($className::$objectCache[$this->id]);
        }
        if ($result) {
            return true;
        }
        trigger_error("Object " . get_class($this) . " delete failed");
        return false;
    }

    public function getId() {
        return $this->id;
    }

    public static function getInstance($id) {
        $className = get_called_class();
        if (isset($className::$objectCache[$id])) {
            return $className::$objectCache[$id];
        }

        return new $className($id);
    }

    public static function getAll($where = array()) {
        $className = get_called_class();
        $results = Database::getInstance()->selectQ("SELECT id FROM " . $className::TABLE_NAME, array());
        $objects = array();
        foreach ($results as $result) {
            $object = $className::getInstance($result['id']);
            if ($object->load()) {
                $objects[] = $object;
            }
        }


        return $objects;
    }

    public abstract function validate();

}