<?php
require_once "database_logic.php";
class ProductsDB extends Database {
    protected $tableName = 'products';
    public function fetchAll(): array
    {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
}

/*
INSERT INTO `products`( `name`, `price`, `img`) VALUES ("Sekiro shadows die twice",1999,"https://tbgames.cz/wp-content/uploads/2019/12/sekiro-shadows-die-twice-cover.jpg");
INSERT INTO `products`( `name`, `price`, `img`) VALUES ("Grand Theft Auto: Vice City",250,"https://tbgames.cz/wp-content/uploads/2021/03/a5d6c023c377c60e5394b0cd5301a6d1_350x200_1x-0-300x400.jpg");
INSERT INTO `products`( `name`, `price`, `img`) VALUES ("Metro Exodus",644,"https://tbgames.cz/wp-content/uploads/2021/02/05arLYlIXEjekOKePkaLSKH4IxzKvLEvAC9XUXstV3M_350x200_1x-0-300x434.jpeg");
INSERT INTO `products`( `name`, `price`, `img`) VALUES ("Red Dead Redemption 2",1301,"https://tbgames.cz/wp-content/uploads/2021/02/6WHraJLANNjJ6IgE7qggRmbBYUJKmkvNHheCxvQfLko_350x200_1x-0-300x421.jpeg");
INSERT INTO `products`( `name`, `price`, `img`) VALUES ("Detroit: Become Human",679,"https://tbgames.cz/wp-content/uploads/2020/11/OHwigC91bAhgTtrpogp-KSOfj9XDDBpfzrZ63FCgZ1Y_350x200_1x-0-300x385.jpg");
INSERT INTO `products`( `name`, `price`, `img`) VALUES ("Farming Simulator 19",694,"https://tbgames.cz/wp-content/uploads/2020/11/ytVBckBQAe3OOaj-5YvNc9n991rQIe9fO_ABsCc2-GE_350x200_1x-0-300x422.jpeg");
INSERT INTO `products`( `name`, `price`, `img`) VALUES ("Fifa 21",677,"https://tbgames.cz/wp-content/uploads/2020/10/fifa-21-cover.jpg.webp");
*/