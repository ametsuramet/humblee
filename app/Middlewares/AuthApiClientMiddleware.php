<?php
namespace App\Middlewares;

use Amet\Humblee\Bases\BaseMiddleware;
use \Firebase\JWT\JWT;

class AuthApiClientMiddleware extends BaseMiddleware {

	protected $routerParams = [
		// ['method' => 'GET', 'uri' => '/home'],
	];

	protected function handle()
	{
		global $config;

		if(!session('token')) {
			header('Location: '.url().$config['app']["guest_redirect"]);
		}
		$key = $config['jwt']['key'];
		$decoded = JWT::decode(session('token'), $key, array('HS256'));
		if ($decoded->iss != env('API_URL')) {
			header('Location: '.url().$config['app']["guest_redirect"]);
		}
		if ($decoded->exp < time()) {
			header('Location: '.url().$config['app']["guest_redirect"]);
		}
		$GLOBALS['authId'] = $decoded->sub;
	}

}

