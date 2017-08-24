<?php
namespace App\Middlewares;

use Amet\Humblee\Bases\BaseMiddleware;

class VerifyCsrfToken extends BaseMiddleware {

	protected $routerParams = [
		['method' => '*', 'uri' => '*'],
	];

	protected function handle()
	{
		if (request()->request->has('_token')) {
			$csrf_value = request()->request->get('_token');
			$session_factory = new \Aura\Session\SessionFactory;
			$session = $session_factory->newInstance($_COOKIE);
			$csrf_token = $session->getCsrfToken();
		    if (! $csrf_token->isValid($csrf_value)) {
		        throw new \Exception("This looks like a cross-site request forgery.");
		    } 
		}
	}

}

