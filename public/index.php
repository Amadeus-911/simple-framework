<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Framework\Kernel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel;

$request = Request::createFromGlobals();

$routes = require_once __DIR__ . '/../routes/api.php';
$context = new RequestContext();
$context->fromRequest($request);

$matcher = new UrlMatcher($routes, $context);

$controllerResolver = new HttpKernel\Controller\ControllerResolver();
$argumentResolver = new HttpKernel\Controller\ArgumentResolver();


$container = include_once __DIR__ . '/../app/container.php';

$kernel = $container->get('kernel');

$response = $kernel->handle($request);


$response->send();