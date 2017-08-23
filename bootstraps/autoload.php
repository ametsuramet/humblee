<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

try {
	require __DIR__.'/loadConfig.php';

	// if (!function_exists('app')) {
	// 	function app()
	// 	{
	// 		global $config;
	// 		require __DIR__.'/../config/database.php';
	// 		$app = new \stdClass;
	// 		$app->db_config = json_decode(json_encode($config['database']));
	// 		return $app;
	// 	}
	// }

	if (!function_exists('request')) {
		function request()
		{
			return Request::createFromGlobals();
		}
	}

	if (!function_exists('auth')) {
		function auth()
		{
			global $authId;
			$user = new \App\Models\User;
			return $user->find($authId);
		}
	}

	if (!function_exists('response')) {
		function response($data, $status = Response::HTTP_OK, $headers = ['content-type' => 'text/json'])
		{
			$res =  new Response(
			    $headers['content-type'] == 'text/json' ? json_encode($data) : $data,
			    $status,
			    $headers
			);

			$res->send();
		}
	}
	if (!function_exists('view')) {
		function view($path, $data)
		{
			$pug    = new Pug\Pug();
	        $vars   = $data ?: array();
	        $output = $pug->render(__DIR__ . '/../resources/views/' . $path . $pug->getExtension(), $vars);
	        echo $output;
		}
	}

	if (!function_exists('view_exception')) {
		function view_exception($path, $data)
		{
			$pug    = new Pug\Pug();
	        $vars   = $data ?: array();
	        $output = $pug->render(__DIR__ . '/../vendor/ametsuramet/humblee-framework/src/resources/exceptions/' . $path . $pug->getExtension(), $vars);
	        echo $output;
		}
	}
	if (!function_exists('url')) {
		function url($params = null){
			$pageURL = "";
			if ($_SERVER["SERVER_PORT"] != "80") {
			  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$params;
			} else {
			  $pageURL .= $_SERVER["SERVER_NAME"].$params;
			}
		  	return sprintf(
		    	"%s://%s",
		    	isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
		    	$pageURL
		  	);
		}
	}
	require __DIR__.'/database.php';
	require __DIR__.'/middleware.php';
	require __DIR__.'/router.php';

} catch (\Exception $e) {
	global $config;
	if ($config['app']['APP_ENV'] != "production" && $config['app']['APP_DEBUG']) {

		$traces = $e->getTrace();
		$message = $e->getMessage();
		return view_exception('exception',compact('message','traces'));
	} else {
		echo "something wrong";
	}
}
