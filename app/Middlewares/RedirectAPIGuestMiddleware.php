<?php
namespace App\Middlewares;

use Amet\Humblee\Bases\BaseMiddleware;
use \Firebase\JWT\JWT;

class RedirectAPIGuestMiddleware extends BaseMiddleware {

	protected $routerParams = [
		// ['method' => 'GET', 'uri' => '/login'],
	];

	protected function handle()
	{
		global $config;
		if (session('token')) {
			$key = $config['jwt']['key'];
			$decoded = JWT::decode(session('token'), $key, array('HS256'));
			if ($decoded->exp < time()) {
				kill_session();
			} else {
				header('Location: '.url().$config['app']["redirect"]);
			}
		}
	}

}

