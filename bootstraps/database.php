<?php
if (!function_exists('db')) {
	function db()
	{
		global $config;
		$dsn = 'mysql:host='.$config['database']['db'][$config['app']['APP_ENV']]['host'].';dbname='.$config['database']['db'][$config['app']['APP_ENV']]['database'].';charset=utf8';
		$usr = $config['database']['db'][$config['app']['APP_ENV']]['user'];
		$pwd = $config['database']['db'][$config['app']['APP_ENV']]['password'];
		return new \Slim\PDO\Database($dsn, $usr, $pwd);
	}
}