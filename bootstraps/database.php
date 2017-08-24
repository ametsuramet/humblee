<?php
if (!function_exists('db')) {
	function db()
	{
		global $config;
		$db_config = $config['database']['db'][$config['app']['APP_ENV']];
		$dsn = 'mysql:host='.$db_config['host'].';dbname='.$db_config['database'].';charset=utf8';
		$usr = $db_config['user'];
		$pwd = $db_config['password'];
		return new \Slim\PDO\Database($dsn, $usr, $pwd);
	}
}