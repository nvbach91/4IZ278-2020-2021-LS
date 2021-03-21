<?php

  class Order extends BaseEntity
  {
    private $createdBy;

    /**
     * Order constructor.
     * @param int $id Entity id
     * @param int $createdBy Author user id
     */
    public function __construct($id, $createdBy)
    {
      parent::__construct($id);
      $this->createdBy = $createdBy;
    }

    /**
     * Getter property for the CreatedBy property
     * @return int User id
     */
    public function getCreatedBy()
    {
      return $this->createdBy;
    }

    public function __toString()
    {
      return sprintf("[%d, %d]", $this->getId(), $this->createdBy);
    }

    public function toCsv($delimiter)
    {
      return sprintf("%d%s%d", $this->getId(), $delimiter, $this->createdBy);
    }

    public static function fromCsv($entry, $delimiter)
    {
      $split = explode($delimiter, $entry);

      return new Order($split[0], $split[1]);
    }
  }