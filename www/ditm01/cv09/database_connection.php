<?php
const DB_HOST = 'localhost';
const DB_DATABASE = 'test';
const DB_USER = 'root';
const DB_PASSWORD = '';

const CURRENCY = 'CZK';

$tableName = 'goods';

$pdo = new PDO(
    'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4',
    DB_USER,
    DB_PASSWORD,
);
