<?php
namespace App\Middlewares;


use \Firebase\JWT\JWT;
use Symfony\Component\HttpFoundation\Request;
use Amet\Humblee\Bases\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware {

	protected $routerParams = [
		['method' => 'GET', 'uri' => '/users'],
		['method' => 'GET', 'uri' => '/users/:id'],
	];

	protected function handle()
	{
		global $config;
		$key = $config['jwt']['key'];
		$jwt = request()->headers->get('token',null);
		$request = new Request;
		$decoded = JWT::decode($jwt, $key, array('HS256'));
		// print_r($decoded);die();
		if ($decoded->iss != url()) {
			throw new \Exception("iss not match");
		}
		if ($decoded->exp < time()) {
			throw new \Exception("JWT Token expired");
		}

		$GLOBALS['authId'] = $decoded->sub;
		
	}

	public static function generateToken($id)
	{
		global $config;

		$key = $config['jwt']['key'];
		$token = array(
		    "sub" => $id,
		    "iss" => url(),
		    "aud" => url(),
		    "iat" => time(),
		    "exp" => time() + $config['jwt']['expired']
		);
		$jwt = JWT::encode($token, $key);
		return $jwt;
	}
}

