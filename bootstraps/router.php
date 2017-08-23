<?php


use Amet\Humblee\Providers\RouterProviders\RouteCollection;
use Amet\Humblee\Providers\RouterProviders\Router;
use Amet\Humblee\Providers\RouterProviders\Route;

$collection = new RouteCollection();
$collection->attachRoute(new Route('/users/', array(
    '_controller' => '\App\Controllers\UserController::index',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/api/login', array(
    '_controller' => '\App\Controllers\AuthController::login_api',
    'methods' => 'POST'
)));


$collection->attachRoute(new Route('/login', array(
    '_controller' => '\App\Controllers\AuthController::login',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/login', array(
    '_controller' => '\App\Controllers\AuthController::postLogin',
    'methods' => 'POST'
)));

$collection->attachRoute(new Route('/logout', array(
    '_controller' => '\App\Controllers\AuthController::logout',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/', array(
    '_controller' => '\App\Controllers\SampleController::index',
    'methods' => 'GET'
)));


$router = new Router($collection);
$router->setBasePath('/');
$route = $router->matchCurrentRequest();

// var_dump($route);