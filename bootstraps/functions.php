<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use \Firebase\JWT\JWT;

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

	if (!function_exists('back')) {
		function back($message = null)
		{
			if ($message) {
				flash('message',$message);
			}
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}

	if (!function_exists('backWithInput')) {
		function backWithInput($message = null,$requests = [])
		{
			$session_factory = new \Aura\Session\SessionFactory;
			$session = $session_factory->newInstance($_COOKIE);
			$segment = $session->getSegment('Amet\Humblee');


			if ($message) {

			}
			$input = [];
			foreach ($requests as $key => $request) {
				$input[$key] = $request;
			}

			$data = [
				'message' => $message,
				'old' => $input,
			];

			$segment->setFlash('message',$data);

			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}

	if (!function_exists('flash')) {
		function flash($key,$message = null)
		{
			$session_factory = new \Aura\Session\SessionFactory;
			$session = $session_factory->newInstance($_COOKIE);
			$segment = $session->getSegment('Amet\Humblee');
			$segment->keepFlash();
			
			if ($message) {
				$segment->setFlash($key,$message);
			} else {
				return $segment->getFlash($key,null);
			}
		}
	}
	if (!function_exists('session')) {
		function session($key,$message = null)
		{
			$session_factory = new \Aura\Session\SessionFactory;
			$session = $session_factory->newInstance($_COOKIE);
			$session->setCookieParams(array('lifetime' => '10'));
			$segment = $session->getSegment('Amet\Humblee');
			$segment->keepFlash();

			if ($message) {
				$segment->set($key,$message);
			} else {
				return $segment->get($key,null);
			}
		}
	}
	if (!function_exists('request')) {
		function request()
		{
			return Request::createFromGlobals();
		}
	}

	if (!function_exists('response')) {
		function response($data, $status = Response::HTTP_OK, $headers = ['content-type' => 'text/json'])
		{
			ini_set('memory_limit', '-1'); 
			$res =  new Response(
			    $headers['content-type'] == 'text/json' ? json_encode($data) : $data,
			    $status,
			    $headers
			);

			$res->send();
		}
	}
	if (!function_exists('view')) {
		function view($path, $data, $return_data = false)
		{

			$session_factory = new \Aura\Session\SessionFactory;
			$session = $session_factory->newInstance($_COOKIE);
			$csrf_value = $session->getCsrfToken()->getValue();
			$pug    = new Pug\Pug();
	        $vars   = $data ?: array();
	        $vars["csrf_token"] = $csrf_value;
	        $output = $pug->render(__DIR__ . '/../resources/views/' . $path . $pug->getExtension(), $vars);
	        	if ($return_data) {
	        		return $output;
	        	}
	        echo $output;
		}
	}

	if (!function_exists('view_exception')) {
		function view_exception($path, $data,$http_error_code = 403, $return_data = false)
		{
			$pug    = new Pug\Pug();
	        $vars   = $data ?: array();
	        $output = $pug->render(__DIR__ . '/../vendor/ametsuramet/humblee-framework/src/resources/exceptions/' . $path . $pug->getExtension(), $vars);
	        http_response_code($http_error_code);
	        if ($return_data) {
	        		return $output;
	        	}
	        echo $output;
		}
	}
	if (!function_exists('base_path')) {
		function base_path($params = null){
			return realpath(__DIR__.'/../').DIRECTORY_SEPARATOR.$params;
		}
	}
	if (!function_exists('storage_path')) {
		function storage_path($params = null){
			return realpath(__DIR__.'/../storage/').DIRECTORY_SEPARATOR.$params;
		}
	}

	if (!function_exists('writelog')) {
		function writelog($message,$level = "info"){
			new Amet\Humblee\Bases\BaseLogs($message,$level);
		}
	}
	if (!function_exists('url')) {
		function url($params = null){
			$pageURL = "";
			global $config;
			if (!isset($_SERVER["SERVER_PORT"])) {
				return $config['app']['APP_URL'].$params;
			}
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
	if (!function_exists('kill_session')) {
		function kill_session(){
			$session_factory = new \Aura\Session\SessionFactory;
			$session = $session_factory->newInstance($_COOKIE);
			$segment = $session->getSegment('Amet\Humblee');
			$session->clear();
			$session->destroy();
			header('Location: '.url().$config['app']["guest_redirect"]);
		}
	}
	if (!function_exists('collection')) {
		function collection($data){
			return new \Amet\Humblee\Bases\ArrayCollection($data);
		}
	}

	if (!function_exists('auth')) {
		function auth(){
			global $config;
			global $authId;
			
			if (isset($authId)) {
				$id = $authId;
			} else {
				$session_factory = new \Aura\Session\SessionFactory;
				$session = $session_factory->newInstance($_COOKIE);
				$segment = $session->getSegment('Amet\Humblee');
				if (!$auth_token = $segment->get('auth_token')) {
					header('Location: '.url().$config['app']["guest_redirect"]);
				}

				$key = $config['jwt']['key'];
				$decoded = JWT::decode($auth_token, $key, array('HS256'));
				if ($decoded->iss != url()) {
					$segment->setFlash('message', 'iss not match');
					header('Location: '.url().$config['app']["guest_redirect"]);
				}
				if ($decoded->exp < time()) {
					$segment->setFlash('message', 'JWT Token expired');
					header('Location: '.url().$config['app']["guest_redirect"]);
				}
				$id = $decoded->sub;
			}

			$user = new \App\Models\User;
			return $user->find($id);
		}
	}
	if (!function_exists('redirect')) {
		function redirect($url){
			header('Location: '.$url);
			exit;
		}
	}
	if (!function_exists('redirect_guest')) {
		function redirect_guest(){
			global $config;
			
			$session_factory = new \Aura\Session\SessionFactory;
			$session = $session_factory->newInstance($_COOKIE);
			$segment = $session->getSegment('Amet\Humblee');
			$segment->keepFlash();
			$auth_token = $segment->get('auth_token');
			if ($auth_token) {

			$key = $config['jwt']['key'];
			$decoded = JWT::decode($auth_token, $key, array('HS256'));
			if ($decoded->iss != url()) {
				return false;
			}
			if ($decoded->exp < time()) {
				return false;
			}
			$id = $decoded->sub;
			header('Location: '.url().$config['app']["redirect"]);
			}
		}
	}
	if (!function_exists('http_rest')) {
		function http_rest($url, $parameters=[], $options=[]){
			$client = new \Positivezero\RestClient($options);
			$client->register_decoder('html',"error_html");
			return $client;
		}
	}
	if (!function_exists('http_get')) {
		function http_get($url, $parameters=[], $options=[]){
			$client = new \Positivezero\RestClient($options);
			$client->register_decoder('html',"error_html");
 			return $client->get($url, $parameters);
		}
	}
	if (!function_exists('http_post')) {
		function http_post($url, $parameters=[], $options=[]){
			$client = new \Positivezero\RestClient($options);
			$client->register_decoder('html',"error_html");

 			return $client->post($url, $parameters);
		}
	}
	if (!function_exists('http_put')) {
		function http_put($url, $parameters=[], $options=[]){
			$client = new \Positivezero\RestClient($options);
			$client->register_decoder('html',"error_html");
 			return $client->put($url, $parameters);
		}
	}
	if (!function_exists('http_delete')) {
		function http_delete($url, $parameters=[], $options=[]){
			$client = new \Positivezero\RestClient($options);
			$client->register_decoder('html',"error_html");
 			return $client->delete($url, $parameters);
		}
	}
	if (!function_exists('error_html')) {
		function error_html($data){
			print_r($data);
			die();
		}
	}

	if (!function_exists('getOId')) {
		function getOId($_id){
			return $_id->{'$oid'};
		}
	}

	if (!function_exists('s3_put')) {
		function s3_put($body,$path = null, $acl = 'public-read'){
			global $config;

			// $s3 = new \Aws\S3\S3Client([
			//     'region'  => $config['s3']['region']
			// ]);
			$s3 = \Aws\S3\S3Client::factory(array(
			    'key'    => $config['s3']['key'],
			    'secret'    => $config['s3']['secret'],
			    'region'  => $config['s3']['region'],
			    'version' => "2006-03-01"
			));
			try {
			    $s3->putObject([
			        'Bucket' => $config['s3']['bucket'],
			        'Body'   => $body,
			        'Key'    => $path, 
			        'ACL'    => $acl,
			    ]);
			    return true;
			} catch (\Aws\S3\Exception\S3Exception $e) {
			    return false;
			}
		}
	}