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
            'name' => strlen($this->data['name']) > 3,
            'gender' => in_array($this->data['gender'], ["m", "f"]),
            'email' => strlen($this->data['email']) > 4 && strpos($this->data['email'], "@") !== false,
            'phone' => strlen($this->data['phone']) > 8 && preg_match("/^[0-9+\s]+$/", $this->data['phone']),
            'avatarURL' => preg_match("/^https?:\/\//", $this->data['avatarURL']),
            'deckName' => strlen($this->data["deckName"]) > 0,
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