<?php
namespace App\Middlewares;

use Amet\Humblee\Bases\BaseMiddleware;

class AuthMiddleware extends BaseMiddleware {

	protected $routerParams = [
		['method' => 'GET', 'uri' => '/auth-user'],
	];

	protected function handle()
	{
		// auth();
		auth();
		// print_r(auth());die();
	}

}

