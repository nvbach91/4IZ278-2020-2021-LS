<?php

final class Registration
{
    public const GENDER_MALE = true;
    public const GENDER_FEMALE = false;

    public $name;
    public $gender;
    public $email;
    public $phone;
    public $avatarURL;
    public $deckName;
    public $deckSize;

    public function __construct(
        string $name,
        bool $gender,
        string $email,
        string $phone,
        string $avatarURL,
        string $deckName,
        int $deckSize
    ) {
        $this->name = $name;
        $this->gender = $gender;
        $this->email = $email;
        $this->phone = $phone;
        $this->avatarURL = $avatarURL;
        $this->deckName = $deckName;
        $this->deckSize = $deckSize;
    }
}