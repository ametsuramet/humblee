<?php


use Amet\Humblee\Providers\RouterProviders\RouteCollection;
use Amet\Humblee\Providers\RouterProviders\Router;
use Amet\Humblee\Providers\RouterProviders\Route;

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

$collection->attachRoute(new Route('/employee', array(
    '_controller' => '\App\Controllers\SampleController::employee',
    'methods' => 'GET'
)));

$router = new Router($collection);
$router->setBasePath('/');
$route = $router->matchCurrentRequest();

// var_dump($route);