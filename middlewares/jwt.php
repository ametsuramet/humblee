<?php
require __DIR__.'/../config/jwt.php';

use \Firebase\JWT\JWT;
use Symfony\Component\HttpFoundation\Request;

$key = $jwt['key'];
// $token = array(
//     "sub" => 1,
//     "iss" => url(),
//     "aud" => url(),
//     "iat" => time(),
//     "exp" => time() + $jwt['expired']
// );
$jwt = request()->headers->get('token',null);
$request = new Request;
/**
 * IMPORTANT:
 * You must specify supported algorithms for your application. See
 * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
 * for a list of spec-compliant algorithms.
sub Subject - This holds the identifier for the token (defaults to user id)
iat Issued At - When the token was issued (unix timestamp)
exp Expiry - The token expiry date (unix timestamp)
nbf Not Before - The earliest point in time that the token can be used (unix timestamp)
iss Issuer - The issuer of the token (defaults to the request url)
jti JWT Id - A unique identifier for the token (md5 of the sub and iat claims)
aud Audience - The intended audience for the token (not required by default)
 */

// $jwt = JWT::encode($token, $key);
try {
	$decoded = JWT::decode($jwt, $key, array('HS256'));
	if ($decoded->exp < time()) {
		throw new \Exception("JWT Token expired");
	}
} catch (\Exception $e) {
	print_r($e->getMessage());
	die();
}
