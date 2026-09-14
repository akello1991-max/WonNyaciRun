<?php

return [
	'default' => env('DB_CONNECTION', 'mysql'),
	'connections' => [
		'mysql' => [
			'driver' => 'mysql',
			'url' => env('DATABASE_URL', env('MYSQL_URL', env('DB_URL'))),
			'host' => env('MYSQLHOST', env('MYSQL_PRIVATE_HOST', env('DB_HOST', '127.0.0.1'))),
			'port' => env('MYSQLPORT', env('MYSQL_PRIVATE_PORT', env('DB_PORT', '3306'))),
			'database' => env('MYSQLDATABASE', env('MYSQL_DATABASE', env('DB_DATABASE', 'won_nyaci_run'))),
			'username' => env('MYSQLUSER', env('MYSQL_USER', env('DB_USERNAME', 'root'))),
			'password' => env('MYSQLPASSWORD', env('MYSQL_PASSWORD', env('DB_PASSWORD', ''))),
			'unix_socket' => env('DB_SOCKET', ''),
			'charset' => 'utf8mb4',
			'collation' => 'utf8mb4_unicode_ci',
			'prefix' => '',
			'prefix_indexes' => true,
			'strict' => true,
			'engine' => null,
			'options' => extension_loaded('pdo_mysql')
				? array_filter([PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA')])
				: [],
		],
	],
	'migrations' => ['table' => 'migrations', 'update_date_on_publish' => true],
	'redis' => [
		'client' => env('REDIS_CLIENT', 'phpredis'),
		'default' => [
			'url' => env('REDIS_URL'),
			'host' => env('REDIS_HOST', '127.0.0.1'),
			'username' => env('REDIS_USERNAME'),
			'password' => env('REDIS_PASSWORD'),
			'port' => env('REDIS_PORT', '6379'),
			'database' => env('REDIS_DB', '0'),
		],
		'cache' => [
			'url' => env('REDIS_URL'),
			'host' => env('REDIS_HOST', '127.0.0.1'),
			'username' => env('REDIS_USERNAME'),
			'password' => env('REDIS_PASSWORD'),
			'port' => env('REDIS_PORT', '6379'),
			'database' => env('REDIS_CACHE_DB', '1'),
		],
	],
];
