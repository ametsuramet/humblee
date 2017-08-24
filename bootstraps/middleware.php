<?php

new \App\Middlewares\JwtMiddleware;
new \App\Middlewares\RedirectGuestMiddleware;
new \App\Middlewares\AuthMiddleware;
new \App\Middlewares\VerifyCsrfToken;