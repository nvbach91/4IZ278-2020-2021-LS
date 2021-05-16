<?php


namespace cv05;


final class DatabaseConfiguration
{
    private $path;

    private $extension;

    private $delimiter;

    public function __construct(string $path, string $extension, string $delimiter) {
        $this->path = $path;
        $this->extension = $extension;
        $this->delimiter = $delimiter;
    }

    public function getPath(): string {
        return $this->path;
    }

    public function getExtension(): string {
        return $this->extension;
    }

    public function getDelimiter(): string {
        return $this->delimiter;
    }
} 
?>