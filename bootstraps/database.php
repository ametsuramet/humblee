<?php
if (!function_exists('db')) {
	function db()
	{
		global $config;
		$dsn = 'mysql:host='.$config['database']['host'].';dbname='.$config['database']['db_name'].';charset=utf8';
		$usr = $config['database']['username'];
		$pwd = $config['database']['password'];
		return new \Slim\PDO\Database($dsn, $usr, $pwd);
	}
}