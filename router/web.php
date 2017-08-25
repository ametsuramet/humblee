<?php

$WebCollection = [
	[
		'url' => '/',
		'_controller' => 'SampleController::index',
		'methods' => 'GET',
	],
	[
		'url' => '/users',
		'_controller' => 'UserController::index',
		'methods' => 'GET',
	],
	[
		'url' => '/employee',
		'_controller' => 'UserController::employee',
		'methods' => 'GET',
	],
	[
		'url' => '/api/login',
		'_controller' => 'AuthController::login_api',
		'methods' => 'POST',
	],
	[
		'url' => '/login',
		'_controller' => 'AuthController::login',
		'methods' => 'GET',
	],
	[
		'url' => '/login',
		'_controller' => 'AuthController::postLogin',
		'methods' => 'POST',
	],
	[
		'url' => '/logout',
		'_controller' => 'AuthController::logout',
		'methods' => 'GET',
	],
	[
		'url' => '/auth-user',
		'_controller' => 'SampleController::auth_user',
		'methods' => 'GET',
	],
];

