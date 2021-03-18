<?php


namespace cv04\src\validation;


/**
 * Class Validations
 * @package cv04\src\requests
 */
final class Validator
{
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function make(string $value): Validator
    {
        return new Validator($value);
    }

    /**
     * @param int $length
     * @return Validator
     * @throws ValidationException
     */
    public function min(int $length): Validator
    {
        $this->assert(
            strlen($this->value) >= $length,
            "Value must be longer than $length characters."
        );

        return $this;
    }

    /**
     * @param int $length
     * @return $this
     * @throws ValidationException
     */
    public function max(int $length): Validator
    {
        $this->assert(
            strlen($this->value) <= $length,
            "Value must be shorter than $length characters."
        );

        return $this;
    }

    /**
     * @param string $pattern
     * @return $this
     * @throws ValidationException
     */
    public function regex(string $pattern): Validator
    {
        $this->assert(
            preg_match($pattern, $this->value),
            "Value doesn't match the required format."
        );

        return $this;
    }

    /**
     * @return $this
     * @throws ValidationException
     */
    public function email(): Validator
    {
        $this->assert(
            filter_var($this->value, FILTER_VALIDATE_EMAIL) !== false,
            "Value is not a valid email."
        );

        return $this;
    }

    /**
     * @param bool $expression
     * @param string|null $message
     * @throws ValidationException
     */
    private function assert(bool $expression, ?string $message = null): void {
        if (!$expression) {
            throw new ValidationException($message ?? "Provided value is not valid.");
        }
    }
}