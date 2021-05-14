<?php


class Task extends Model
{
    private $id;
    private $name;
    private $storyPoints;
    private $assignee;
    private $description;

    /**
     * Task constructor.
     * @param $id
     * @param $name
     * @param $storyPoints
     * @param $assignee
     * @param $description
     */

    /**
     * Task constructor.
     * @param $id
     * @param $name
     * @param $storyPoints
     * @param $assignee
     * @param $description
     */
    public function __construct($id, $name, $storyPoints, $assignee, $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->storyPoints = $storyPoints;
        $this->assignee = $assignee;
        $this->description = $description;
    }

}