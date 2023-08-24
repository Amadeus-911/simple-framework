<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing;
use App\Http\Controllers\User;

$routes = new RouteCollection();

$routes->add('hello', new Route('api/hello/{name}', [
    'name' => 'world',
    '_controller' => 'App\Http\Controllers\User::getName'
]));
$routes->add('bye', new Route('api/bye'));

return $routes;