<?php


class Project extends Model
{
    private $id;
    private $name;
    private $desc;

    /**
     * Project constructor.
     * @param $id
     * @param $name
     * @param $desc
     */

    /**
     * Project constructor.
     * @param $id
     * @param $name
     * @param $desc
     */
    public function __construct($id, $name, $desc)
    {
        $this->id = $id;
        $this->name = $name;
        $this->desc = $desc;
    }

}