<?php


class Product
{
    private $gameId;
    private $title;
    private $price;
    private $category;
    private $description;
    private $discount;
    private $img;

    /**
     * Product constructor.
     * @param $gameId
     * @param $title
     * @param $price
     * @param $category
     * @param $description
     * @param $discount
     * @param $img
     */
    public function __construct($gameId, $title, $price, $category, $description, $discount,$img)
    {
        $this->gameId = $gameId;
        $this->title = $title;
        $this->price = $price;
        $this->category = $category;
        $this->description = $description;
        $this->discount = $discount;
        $this->img = $img;
    }

    /**
     * @return mixed
     */
    public function getGameId()
    {
        return $this->gameId;
    }

    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param mixed $img
     */
    public function setImg($img): void
    {
        $this->img = $img;
    }

    /**
     * @param mixed $gameId
     */
    public function setGameId($gameId): void
    {
        $this->gameId = $gameId;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param mixed $discount
     */
    public function setDiscount($discount): void
    {
        $this->discount = $discount;
    }



}