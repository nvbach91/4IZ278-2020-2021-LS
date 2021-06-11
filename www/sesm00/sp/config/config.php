<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'semestralka');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_PREFIX', '');

define('CURRENCY', 'Kč');
define('PRODUCTS_PER_PAGE', 2);
define('TIME_ZONE', "Europe/Prague");

define('BASE_URL', getBaseUrl());

define('APP_SSL_VERIFY_PEER', false);


/**
 * Tables
 */

define('CATEGORIES_TABLE', DB_PREFIX . "categories");
define('ADDRESS_TABLE', DB_PREFIX . "delivery_addresses");
define('ORDER_TABLE', DB_PREFIX . "orders");
define('ORDER_PRODUCT_TABLE', DB_PREFIX . "order_products");
define('ORDER_PRODUCT_FIELDS_TABLE', DB_PREFIX . "order_product_fields");
define('PRODUCTS_TABLE', DB_PREFIX . "products");
define('STATES_TABLE', DB_PREFIX . "states");
define('USERS_TABLE', DB_PREFIX . 'users');
