<?php


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing;

$routes = new RouteCollection();

$routes->add('hello', new Route('/hello/{name}', [
    'name' => 'world',
]));
$routes->add('bye', new Route('/bye'));

return $routes;