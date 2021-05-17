<?php

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/database/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/database/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'cechie_dubec',
            'user' => 'root',
            'pass' => '',
            'port' => '3300',
            'charset' => 'utf8',
            'unix_socket' => '/opt/lampp/var/mysql/mysql.sock',
        ],
        'development' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'cechie_dubec',
            'user' => 'root',
            'pass' => '',
            'port' => '3300',
            'charset' => 'utf8',
            'unix_socket' => '/opt/lampp/var/mysql/mysql.sock',
        ],
        'testing' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'cechie_dubec',
            'user' => 'root',
            'pass' => '',
            'port' => '3300',
            'charset' => 'utf8',
            'unix_socket' => '/opt/lampp/var/mysql/mysql.sock',
        ]
    ],
    'version_order' => 'creation'
];
