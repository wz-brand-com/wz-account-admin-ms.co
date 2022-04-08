<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DATABASE_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],

        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

          // second db getting databse from maanger count db
          'mysqlManager' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_EVENT', '127.0.0.1'),
            'port' => env('DB_PORT_EVENT', '3306'),
            'database' => env('DB_DATABASE_EVENT', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],
          // second db getting databse from SITE ADMIN TASK TYPE
          'mysqlSiteAdminTaskType' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_SITE_ADMIN_TASK_TYPE_COUNT', 'localhost'),
            'port' => env('DB_PORT_SITE_ADMIN_TASK_TYPE_COUNT', '3306'),
            'database' => env('DB_DATABASE_SITE_ADMIN_TASK_TYPE_COUNT', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

         // second db getting databse from user count db
         'mysqlUser' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_USER_COUNT', '127.0.0.1'),
            'port' => env('DB_PORT_USER_COUNT', '3306'),
            'database' => env('DB_DATABASE_USER_COUNT', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

        // task type count db
        'mysqlTasktype' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_TASKTYPE_COUNT', '127.0.0.1'),
            'port' => env('DB_PORT_TASKTYPE_COUNT', '3306'),
            'database' => env('DB_DATABASE_TASKTYPE_COUNT', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],
           // task board count db
           'mysqlTASKS_BOARD' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_TASKS_BOARD_COUNT', '127.0.0.1'),
            'port' => env('DB_PORT_TASKS_BOARD_COUNT', '3306'),
            'database' => env('DB_DATABASE_TASKS_BOARD_COUNT', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],
           // Team Rating count db
           'mysqlTeamRating' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_TEAM_RATING_COUNT', '127.0.0.1'),
            'port' => env('DB_PORT_TEAM_RATING_COUNT', '3306'),
            'database' => env('DB_DATABASE_TEAM_RATING_COUNT', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],
         // mysqlIntervalTask count db
         'mysqlIntervalTask' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_INTERVAL_TASK_COUNT', '127.0.0.1'),
            'port' => env('DB_PORT_INTERVAL_TASK_COUNT', '3306'),
            'database' => env('DB_DATABASE_INTERVAL_TASK_COUNT', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],
        // Add url count db
        'mysqlAddurl' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_ADDURL_COUNT', '127.0.0.1'),
            'port' => env('DB_PORT_ADDURL_COUNT', '3306'),
            'database' => env('DB_DATABASE_ADDURL_COUNT', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],
        // Projects count db
        'mysqlProjects' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_PROJECTS_COUNT', '127.0.0.1'),
            'port' => env('DB_PORT_PROJECTS_COUNT', '3306'),
            'database' => env('DB_DATABASE_PROJECTS_COUNT', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],
        // Keyword count db
        'mysqlKeywords' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_KEYWORDS_COUNT', '127.0.0.1'),
            'port' => env('DB_PORT_KEYWORDS_COUNT', '3306'),
            'database' => env('DB_DATABASE_KEYWORDS_COUNT', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],
        // social rank count db
        'mysqlSocialRank' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_SOCIALRANK_COUNT', '127.0.0.1'),
            'port' => env('DB_PORT_SOCIALRANK_COUNT', '3306'),
            'database' => env('DB_DATABASE_SOCIALRANK_COUNT', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],
        // web rank count db
        'mysqlWebRank' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_WEBRANK_COUNT', '127.0.0.1'),
            'port' => env('DB_PORT_WEBRANK_COUNT', '3306'),
            'database' => env('DB_DATABASE_WEBRANK_COUNT', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],


         

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'predis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'predis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_DB', 0),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_CACHE_DB', 1),
        ],

    ],

];
