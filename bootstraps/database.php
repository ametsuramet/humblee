<?php
// print_r(app()->db_config->host);


// $pdo = new \Slim\PDO\Database($dsn, $usr, $pwd);

if (!function_exists('db')) {
	function db()
	{
		$dsn = 'mysql:host='.app()->db_config->host.';dbname='.app()->db_config->db_name.';charset=utf8';
		$usr = app()->db_config->username;
		$pwd = app()->db_config->password;
		return new \Slim\PDO\Database($dsn, $usr, $pwd);
	}
}