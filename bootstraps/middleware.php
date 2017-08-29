<?php

new \App\Middlewares\JwtMiddleware;
new \App\Middlewares\RedirectGuestMiddleware;
new \App\Middlewares\RedirectAPIGuestMiddleware;
new \App\Middlewares\AuthMiddleware;
new \App\Middlewares\VerifyCsrfToken;
new \App\Middlewares\AuthApiClientMiddleware;