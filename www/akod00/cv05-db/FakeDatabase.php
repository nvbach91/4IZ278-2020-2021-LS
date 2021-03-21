<?php
  require "DatabaseOperations.php";

  /**
   * Fake database provider
   */
  abstract class FakeDatabase implements DatabaseOperations
  {
    private $name;
    private $entityName;
    private $dbPath = __DIR__ . '/';
    private $dbExtension = '.db';
    private $delimiter = ';';

    private $data = [];

    /**
     * FakeDatabase constructor.
     * @param $name string name
     * @param $entityName string database entity name
     */
    public function __construct($name, $entityName)
    {
      $this->name = $name;
      $this->entityName = $entityName;
      echo "An instance of " . $this->getName() . " has been instantiated" . "\n";
      if (!file_exists($this->getDbPath())) {
        touch($this->getDbPath());
      }
    }

    /**
     * Getter method for the Name property
     * @return string name
     */
    public function getName()
    {
      return $this->name;
    }

    public function getConfig()
    {
      echo "Path: " . $this->dbPath . ", Ext: " . $this->dbExtension . ", Del: " . $this->delimiter, PHP_EOL;
    }

    /**
     * @param string $dbPath
     */
    public function setDbBasePath($dbPath)
    {
      $this->dbPath = $dbPath;
    }

    /**
     * @return string
     */
    public function getDbExtension()
    {
      return $this->dbExtension;
    }

    /**
     * @param string $dbExtension
     */
    public function setDbExtension($dbExtension)
    {
      $this->dbExtension = $dbExtension;
    }

    /**
     * @return string
     */
    public function getDelimiter()
    {
      return $this->delimiter;
    }

    /**
     * @param string $delimiter
     */
    public function setDelimiter($delimiter)
    {
      $this->delimiter = $delimiter;
    }

    public function __toString()
    {
      return $this->getName();
    }

    public function fetch()
    {
      $this->data = [];
      $lines = file($this->getDbPath());
      foreach ($lines as $line) {
        $line = trim($line);

        if (!$line) {
          continue;
        }

        $this->data[] = $this->parseCsv($line);
      }

      echo "A total of " . count($this->data) . " '" . $this->getEntityName() . "' entities were fetched" . "\n";
    }

    /**
     * @return string
     */
    public function getDbPath()
    {
      return $this->dbPath . $this->name . $this->dbExtension;
    }

    abstract public function parseCsv($line);

    /**
     * Getter method for the EntityName property
     * @return string entity name
     */
    public function getEntityName()
    {
      return $this->entityName;
    }

    /**
     * Create a new
     * @param BaseEntity $entity Instance of an entity
     */
    public function create($entity)
    {
      if ($this->getById($entity->getId()) !== null) {
        echo "Attempt to create a duplicate entry\n";
        return;
      }

      echo "Created a new instance of a " . $this->getEntityName() . " entity: " . $entity . "\n";

      $this->data[] = $entity;
    }

    public function getById($id)
    {
      foreach ($this->data as $entry) {
        if ($entry->getId() === $id) {
          return $entry;
        }
      }

      return null;
    }

    public function save()
    {
      foreach ($this->data as $entry) {
        $line = $entry->toCsv($this->delimiter) . "\n";
        file_put_contents($this->getDbPath(), $line, FILE_APPEND);
      }

      echo "A total of" . count($this->data) . " '" . $this->getEntityName() . "' entities were saved" . "\n";
    }

    public function delete($entity)
    {
      $entry = $this->getById($entity->getId());

      if (($entry !== null) && ($key = array_search($entry, $this->data, true)) !== false) {
        unset($this->data[$key]);
        echo "A '" . $this->getEntityName() . "' entity was deleted" . "\n";
      } else {
        echo "Attempt to delete unknown entity\n";
      }

    }

    protected function getData()
    {
      return $this->data;
    }


  }