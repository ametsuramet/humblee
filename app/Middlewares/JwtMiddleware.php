<?php
namespace App\Middlewares;


use \Firebase\JWT\JWT;
use Symfony\Component\HttpFoundation\Request;


class JwtMiddleware extends BaseMiddleware {

	protected $routerParams = [
		['method' => 'GET', 'uri' => '/users']
	];

	protected function handle()
	{
		global $config;

		$key = $config['jwt']['key'];
		$jwt = request()->headers->get('token',null);
		$request = new Request;
		try {
			$decoded = JWT::decode($jwt, $key, array('HS256'));
			if ($decoded->exp < time()) {
				throw new \Exception("JWT Token expired");
			}
		} catch (\Exception $e) {
			// print_r($e->getMessage());
			die($e->getMessage());
		}
	}

	public function generateToken($id)
	{
		require __DIR__.'/../../config/jwt.php';

		$key = $jwt['key'];
		$token = array(
		    "sub" => $id,
		    "iss" => url(),
		    "aud" => url(),
		    "iat" => time(),
		    "exp" => time() + $jwt['expired']
		);
		$jwt = JWT::encode($token, $key);
		return $jwt;
	}
}

