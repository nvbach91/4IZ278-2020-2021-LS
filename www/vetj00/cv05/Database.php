<?php


namespace cv05;


use DateTime;

abstract class Database implements DatabaseOperations
{
    protected $configuration;

    public function __construct(DatabaseConfiguration $configuration) {
        $this->configuration = $configuration;
    }

    public function __toString(): string {
        return "Database(" . static::class . ") {\n" .
            "\tpath      : \"{$this->configuration->getPath()}\",\n" .
            "\textension : \"{$this->configuration->getExtension()}\",\n" .
            "\tdelimiter : \"{$this->configuration->getDelimiter()}\"\n" .
        "}\n";
    }

    protected function log(string $message) {
        // TODO: Maybe connect monolog / logger?
        $time = (new DateTime())->format("[H:i:s]");

        echo "$time $message\n";
    }
} 
?>