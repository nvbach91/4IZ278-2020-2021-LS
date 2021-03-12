<?php


final class Validator
{
    private $data;

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function validate(): bool {
        return empty($this->getViolatedRules());
    }

    public function getViolatedRules(): array {
        $rules = [
            'name' => strlen(trim($this->data['name'])) > 3,
            'gender' => in_array($this->data['gender'], [Registration::GENDER_MALE, Registration::GENDER_FEMALE]),
            'email' => strlen(trim($this->data['email'])) > 4 && filter_var(trim($this->data['email']), FILTER_VALIDATE_EMAIL),
            'phone' => strlen($this->data['phone']) > 8 && preg_match("/^[0-9+\s]+$/", $this->data['phone']),
            'avatarURL' => preg_match("/^https?:\/\//", $this->data['avatarURL']),
            'deckName' => strlen(trim($this->data["deckName"])) > 0,
            'deckSize' => is_numeric($this->data["deckSize"]) && (int) $this->data["deckSize"] > 0 // or 60?
        ];

        $violations = [];

        foreach ($rules as $attribute => $rule) {
            if (!isset($this->data[$attribute]) || !$rule) {
                $violations[] = $attribute;
            }
        }

        return $violations;
    }
}