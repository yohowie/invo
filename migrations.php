<?php
declare(strict_types=1);

use Dotenv\Dotenv;
use Phalcon\Config;

const BASE_PATH = __DIR__;
const APP_PATH = BASE_PATH . '/app';

Dotenv::createImmutable(BASE_PATH)->safeLoad();

return new Config([
    'database' => [
        'adapter'     => $_ENV['DB_ADAPTER']  ?? 'Mysql',
        'host'        => $_ENV['DB_HOST']     ?? '',
        'username'    => $_ENV['DB_USERNAME'] ?? '',
        'password'    => $_ENV['DB_PASSWORD'] ?? '',
        'dbname'      => $_ENV['DB_DBNAME']   ?? '',
        'charset'     => $_ENV['DB_CHARSET']  ?? 'utf8mb4',
    ],
    'application' => [
        'migrationsDir'     => APP_PATH . '/migrations/',
        'migrationsTsBased' => false,
        'logInDb'           => true,
        'exportDataFromTables' => [
            'companies',
            'product_types',
            'products',
            'users'
        ]
    ]
]);
