<?php

namespace Framework;

use Framework\Events\ResponseEvent;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel;
use App\Http\Controllers\User;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;

class Kernel
{

    public function __construct(
        private EventDispatcher $dispatcher,
        private UrlMatcher $matcher,
        private ControllerResolver $controllerResolver,
        private ArgumentResolver $argumentResolver
    ){}

    public function handle(Request $request) : Response{
        $response = new Response();


        // $content = '';
        // $path = $request->getPathInfo();
        // $map = [
        //     "/hello" =>  __DIR__ . '/../resources/views/hello.php',
        //     "/bye" =>  __DIR__ . '/../resources/views/bye.php'
        // ];

        // if(isset($map[$path])){
        //     $content = require $map[$path];
        // }else{
        //     $response->setStatusCode(404);
        //     $response->setContent('Not Found');
        // }
        $attributes = $this->matcher->match($request->getPathInfo());
        




       try{
           $request->attributes->add($attributes);

           $controller = $this->controllerResolver->getController($request);
           $arguments = $this->argumentResolver->getArguments($request, $controller);
           $response = call_user_func_array($controller, $arguments);

       }catch (ResourceNotFoundException $exception){
           $response   = new Response('Not Found', 404);
       }

       $this->dispatcher->dispatch(new ResponseEvent($response, $request), 'response');
        // $response->setContent($content);

        return $response;
    }
}