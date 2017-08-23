<?php

return [
	'APP_ENV' => getenv('APP_ENV','development'),
	'APP_DEBUG' => getenv('APP_DEBUG',true),
	'guest_redirect' => "/login",
	'redirect' => "/auth-user",
];