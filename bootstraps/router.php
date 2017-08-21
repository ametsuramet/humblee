<?php


use PHPRouter\RouteCollection;
use PHPRouter\Router;
use PHPRouter\Route;

$collection = new RouteCollection();
$collection->attachRoute(new Route('/users/', array(
    '_controller' => '\App\Controllers\IndexController::users',
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