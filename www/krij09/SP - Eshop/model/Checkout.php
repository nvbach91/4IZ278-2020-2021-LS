<?php


class Checkout
{

    private $checkoutId;
    private $gameId;
    private $userId;
    private $count;

    /**
     * Checkout constructor.
     * @param $checkoutId
     * @param $gameId
     * @param $userId
     * @param $count
     */
    public function __construct($checkoutId, $gameId, $userId, $count)
    {
        $this->checkoutId = $checkoutId;
        $this->gameId = $gameId;
        $this->userId = $userId;
        $this->count = $count;
    }

    /**
     * @return mixed
     */
    public function getCheckoutId()
    {
        return $this->checkoutId;
    }

    /**
     * @param mixed $checkoutId
     */
    public function setCheckoutId($checkoutId): void
    {
        $this->checkoutId = $checkoutId;
    }

    /**
     * @return mixed
     */
    public function getGameId()
    {
        return $this->gameId;
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
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param mixed $count
     */
    public function setCount($count): void
    {
        $this->count = $count;
    }



}