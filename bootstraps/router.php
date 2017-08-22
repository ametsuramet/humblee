<?php


use App\Providers\RouteProviders\RouteCollection;
use App\Providers\RouteProviders\Router;
use App\Providers\RouteProviders\Route;

$collection = new RouteCollection();
$collection->attachRoute(new Route('/users/', array(
    '_controller' => '\App\Controllers\SampleController::users',
    'methods' => 'GET'
)));

$collection->attachRoute(new Route('/users/:id', array(
    '_controller' => '\App\Controllers\SampleController::profile',
    'methods' => 'GET',
)));

$collection->attachRoute(new Route('/', array(
    '_controller' => '\App\Controllers\SampleController::index',
    'methods' => 'GET'
)));

$router = new Router($collection);
$router->setBasePath('/');
$route = $router->matchCurrentRequest();

// var_dump($route);