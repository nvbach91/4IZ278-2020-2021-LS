<?php
  require "DatabaseOperations.php";

  /**
   * Fake database provider
   */
  abstract class FakeDatabase implements DatabaseOperations
  {
    private $name;
    private $entityName;
    private $dbPath = '/external/db/';
    private $dbExtension = '.db';
    private $delimiter = ';';

    /**
     * FakeDatabase constructor.
     * @param $name string name
     * @param $entityName string database entity name
     */
    public function __construct($name, $entityName)
    {
      $this->name = $name;
      $this->entityName = $entityName;
      echo "An instance of " . $this->getName() . " has been instantiated", PHP_EOL;
    }

    public function getConfig() {
      echo "Path: " . $this->dbPath . ", Ext: " . $this->dbExtension . ", Del: " . $this->delimiter, PHP_EOL;
    }

    /**
     * @return string
     */
    public function getDbPath()
    {
      return $this->dbPath;
    }

    /**
     * @param string $dbPath
     */
    public function setDbPath($dbPath)
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

    /**
     * Getter method for the Name property
     * @return string name
     */
    public function getName()
    {
      return $this->name;
    }

    public function __toString()
    {
      return $this->getName();
    }

    public function fetch()
    {
      echo "A '" . $this->getEntityName() . "' entity was fetched", PHP_EOL;
    }

    /**
     * Create a new
     * @param BaseEntity $entity Instance of an entity
     */
    public function create($entity)
    {
      echo "Created a new instance of a " . $this->getEntityName() . " entity: " . $entity, PHP_EOL;
    }

    /**
     * Getter method for the EntityName property
     * @return string entity name
     */
    public function getEntityName()
    {
      return $this->entityName;
    }

    public function save()
    {
      echo "A '" . $this->getEntityName() . "' entity was saved", PHP_EOL;
    }

    public function delete()
    {
      echo "A '" . $this->getEntityName() . "' entity was deleted", PHP_EOL;
    }
  }