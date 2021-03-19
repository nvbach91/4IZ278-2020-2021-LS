<?php


namespace cv05;


use DateTime;
use InvalidArgumentException;

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

    protected function loadDatabaseItems(): array {
        $file = __DIR__ . $this->configuration->getPath() . $this->configuration->getExtension();

        if (!file_exists($file)) {
            throw new InvalidArgumentException("File $file not found.");
        }

        $content = file_get_contents($file);
        $lines = explode("\n", $content);

        return array_map(
            function ($line) {
                return explode($this->configuration->getDelimiter(), $line);
            },
            $lines
        );
    }

    protected function storeDatabaseItems(array $data): void {
        $file = __DIR__ . $this->configuration->getPath() . $this->configuration->getExtension();

        if (!file_exists($file)) {
            throw new InvalidArgumentException("File $file not found.");
        }

        $serialized = array_map(
            function ($row) {
                return implode($this->configuration->getDelimiter(), $row);
            },
            $data
        );

        file_put_contents($file, implode("\n", $serialized));
    }

    protected function log(string $message) {
        // TODO: Maybe connect monolog / logger?
        $time = (new DateTime())->format("[H:i:s]");

        echo "$time $message\n";
    }
}