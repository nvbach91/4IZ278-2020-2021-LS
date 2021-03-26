<?php


namespace cv06\database;


use PDO;

final class EshopDatabase
{
    private $pdo;

    private static $instance;

    private const FETCH_MODE = PDO::FETCH_ASSOC;

    private function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        self::$instance = $this;
    }

    public static function connect(PDO $pdo): void {
        (new EshopDatabase($pdo))->createSchema();
    }

    public static function instance(): EshopDatabase {
        return self::$instance;
    }

    public function createSchema(): void {
        $query = <<<SQL
CREATE TABLE IF NOT EXISTS categories (
    `category_id` INT  AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `number`      INT                 NOT NULL,
    `name`        TEXT                NOT NULL
);

CREATE TABLE IF NOT EXISTS `products` (
    `product_id`  INT  AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `name`        TEXT                NOT NULL,
    `price`       INT                 NOT NULL,
    `image_url`   TEXT                    NULL,
    `category_id` INT                 NOT NULL,
    
    FOREIGN KEY (`category_id`) 
        REFERENCES `categories`(`category_id`)
        ON DELETE CASCADE 
);

CREATE TABLE IF NOT EXISTS `slides` (
    `slide_id`    INT  AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `name`        TEXT                NOT NULL,
    `image_url`   TEXT                NOT NULL
);
SQL;

        $this->pdo->exec($query);
    }

    public function findAllCategories(): array {
        $query = <<<SQL
SELECT `categories`.`category_id`, `categories`.`number`, `categories`.`name`, count(`products`.`product_id`) as `products_count` FROM `categories` 
    LEFT JOIN `products` ON `categories`.`category_id` = `products`.`category_id`
    GROUP BY `categories`.`category_id`, `categories`.`number`, `categories`.`name`
SQL;

        $statement = $this->pdo->prepare($query);
        $statement->execute();

        return $statement->fetchAll(self::FETCH_MODE);
    }

    public function findAllProducts(): array {
        $statement = $this->pdo->prepare("select * from `products`");
        $statement->execute();

        return $statement->fetchAll(self::FETCH_MODE);
    }

    public function findAllSlides(): array {
        $statement = $this->pdo->prepare("select * from `slides`");
        $statement->execute();

        return $statement->fetchAll(self::FETCH_MODE);
    }

    public function findAllProductsByCategory(int $categoryId): array {
        $statement = $this->pdo->prepare("select * from `products` where `category_id` = :category_id");
        $statement->bindParam("category_id", $categoryId);
        $statement->execute();

        return $statement->fetchAll(self::FETCH_MODE);
    }
}