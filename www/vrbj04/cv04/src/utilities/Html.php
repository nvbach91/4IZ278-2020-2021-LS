<?php


namespace cv04\src\utilities;


final class Html
{
    public static function sanitize(string $value): string {
        return htmlspecialchars($value, ENT_QUOTES);
    }

    public static function error(string $attribute, array $violations): string {
        if (!array_key_exists($attribute, $violations)) {
            return "";
        }

        return "<small class='text-danger'>" . $violations[$attribute] . "</small>";
    }

    public static function errorClass(string $attribute, array $violations): string {
        if (!array_key_exists($attribute, $violations)) {
            return "";
        }

        // The spaces around are intentional, so this can be inlined
        // with other css classes without accidentally breaking them
        return " is-invalid ";
    }

    public static function value(string $attribute, array $request): string {
        if (!array_key_exists($attribute, $request)) {
            return "";
        }

        return self::sanitize($request[$attribute]);
    }
}