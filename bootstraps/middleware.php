<?php

// require __DIR__.'/../middlewares/jwt.php';

$jwt = new \App\Middlewares\JwtMiddleware;
$auth = new \App\Middlewares\RedirectGuestMiddleware;
$auth = new \App\Middlewares\AuthMiddleware;