<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class User
{
    public function getName(Request $request): Response {
        $name = $request->query->get('name', 'world');
        $data = ['name' => $name];
        $json = json_encode($data);
        $response = new Response();
        $response->setContent($json);
        $response->headers->set('content-type', 'application/json');
        return $response;
    }
}