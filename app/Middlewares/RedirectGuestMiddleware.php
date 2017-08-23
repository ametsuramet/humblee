<?php
namespace App\Middlewares;

use Amet\Humblee\Bases\BaseMiddleware;

class RedirectGuestMiddleware extends BaseMiddleware {

	protected $routerParams = [
		['method' => 'GET', 'uri' => '/login'],
	];

	protected function handle()
	{
		redirect_guest();
	}

}

