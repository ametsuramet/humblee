<?php

return [
	'APP_ENV' => env('APP_ENV','development'),
	'APP_URL' => env('APP_URL','localhost'),
	'APP_DEBUG' => env('APP_DEBUG',true),
	'guest_redirect' => "/login",
	'redirect' => "/auth-user",
	'timezone' => 'Asia/Jakarta',
	'log' => "daily", //single,daily
];