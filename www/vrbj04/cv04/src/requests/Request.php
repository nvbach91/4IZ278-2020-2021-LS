<?php


namespace cv04\src\requests;


use cv04\src\validation\ValidationException;

abstract class Request
{
    protected abstract function rules(): array;

    public function violations(array $input): array {
        $rules = $this->rules();
        $violations = [];

        foreach ($rules as $attribute => $rule) {
            if (!array_key_exists($attribute, $input)) {
                $violations[] = $attribute;
                continue;
            }

            $sanitized = htmlspecialchars(trim($input[$attribute]));

            try {
                $rule($sanitized);
            }
            catch (ValidationException $exception) {
                $violations[$attribute] = $exception->getMessage();
            }
        }
        
        return $violations;
    }
}