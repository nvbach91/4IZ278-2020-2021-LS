<?php

  /**
   * Fake database provider
   */
  abstract class FakeDatabase implements DatabaseOperations
  {
    private $name;
    private $entityName;

    /**
     * FakeDatabase constructor.
     * @param $name string name
     * @param $entityName string database entity name
     */
    public function __construct($name, $entityName)
    {
      $this->name = $name;
      $this->entityName = $entityName;
      echo "An instance of " . $this->getName() . " has been instantiated";
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