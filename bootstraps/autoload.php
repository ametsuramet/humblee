<?php

$dotenv = new Dotenv\Dotenv(__DIR__.'/../');
$dotenv->load();


try {
	require __DIR__.'/loadConfig.php';
	require __DIR__.'/functions.php';
	require __DIR__.'/database.php';
	require __DIR__.'/middleware.php';
	new Amet\Humblee\Bases\BaseRouter;

} catch (\Exception $e) {
	global $config;
	if ($config['app']['APP_ENV'] != "production" && $config['app']['APP_DEBUG'] != "false") {
		$traces = $e->getTrace();
		$message = $e->getMessage();
		return view_exception('exception',compact('message','traces'));
	} 
	if ($config['app']['APP_DEBUG'] == "false") {
		$traces = [];
		$message = $e->getMessage();
		return view_exception('exception',compact('message','traces'));
	}
	return view_exception('something',[]);
}
