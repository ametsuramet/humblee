<?php
if (!function_exists('db')) {
	function db()
	{
		global $config;
		$db_config = $config['database']['db'][env('DB_CONNECTION','development')];
		$dsn = 'mysql:host='.$db_config['host'].';dbname='.$db_config['database'].';charset=utf8';
		$usr = $db_config['user'];
		$pwd = $db_config['password'];
		return new \Slim\PDO\Database($dsn, $usr, $pwd);
	}
}

if (!function_exists('mongo')) {
	function mongo()
	{
		global $config;
		// print_r($config['mongo']);
		$db_config = $config['mongo']['db'][env('MONGO_CONNECTION','development')];
		$config_str = "";
		if ($db_config['user'] && $db_config['password']) {
			$config_str .= "mongodb://".$db_config['user'].":".$db_config['password']."@".$db_config['host'].":".$db_config['port'];
			return new MongoDB\Client($db_config);
		}
		return new MongoDB\Client();
	}
}