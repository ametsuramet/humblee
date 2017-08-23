<?php
date_default_timezone_set('UTC');

//----------------------------
// DATABASE CONFIGURATION
//----------------------------

/*

Valid types (adapters) are Postgres & MySQL:

'type' must be one of: 'pgsql' or 'mysql' or 'sqlite'

*/
return array(
    'db' => array(
        'development' => array(
            'type' => 'mysql',
            'host' => getenv('DB_HOST','localhost'),
            'port' => getenv('DB_PORT',3306),
            'database' => getenv('DB_DATABASE',null),
            'user' => getenv('DB_USERNAME','root'),
            'password' => getenv('DB_PASSWORD','root'),
            //'charset' => 'utf8',
            //'directory' => 'custom_name',
            //'socket' => '/var/run/mysqld/mysqld.sock'
        ),
        'pg_test' => array(
            'type' => 'pgsql',
            'host' => 'localhost',
            'port' => 5432,
            'database' => 'ruckusing_migrations_test',
            'user' => 'postgres',
            'password' => '',
            //'directory' => 'custom_name',

        ),
        'mysql_test' => array(
            'type' => 'mysql',
            'host' => 'localhost',
            'port' => 3306,
            'database' => 'ruckusing_migrations_test',
            'user' => 'root',
            'password' => '',
            //'directory' => 'custom_name',
            //'socket' => '/var/run/mysqld/mysqld.sock'
        ),
        'sqlite_test' => array(
            'type' => 'sqlite',
            'database' => __DIR__ .'/..' . '/test.sqlite3',
            'host' => 'localhost',
            'port' => '',
            'user' => '',
            'password' => ''
        )

    ),
    'migrations_dir' => array('default' => __DIR__ .'/..' . '/migrations'),
    'db_dir' => __DIR__ .'/..' . DIRECTORY_SEPARATOR . 'db',
    'log_dir' => __DIR__ .'/..' . DIRECTORY_SEPARATOR . 'logs',
    'ruckusing_base' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..'
);
