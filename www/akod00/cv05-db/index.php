<?php

  require_once "FakeDatabase.php";
  require "UsersDb.php";
  require "User.php";
  require "ProductsDb.php";
  require "Product.php";
  require "OrdersDb.php";
  require "Order.php";

  $users = new UsersDB();
  $users->getConfig();

  $users->create(new User(1, "Bob"));
  $users->create(new User(2, "Bill"));
  $users->fetch();
  $users->save();
  $users->delete();
  echo PHP_EOL;

  $products = new ProductsDB();
  $users->getConfig();
  $products->create(new Product(1, "BTC", 50000));
  $products->create(new Product(2, "ETH", 1500));
  echo PHP_EOL;

  $orders = new OrdersDB();
  $users->getConfig();
  echo PHP_EOL;
  echo $orders, PHP_EOL;
  $orders->create(new Order(1, 1, [1, 2]));
  echo $orders, PHP_EOL;
