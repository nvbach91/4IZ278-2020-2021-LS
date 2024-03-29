<?php


namespace cv04\src\utilities;


final class Redirect
{
    public static function to(string $url): void {
        ob_clean();
        header("Location: $url");
        exit;
    }
}