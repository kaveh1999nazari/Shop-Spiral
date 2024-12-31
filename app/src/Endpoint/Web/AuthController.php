<?php

namespace App\Endpoint\Web;


use Illuminate\Support\Facades\Http;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Spiral\Http\Request\InputManager;
use Spiral\RoadRunner\GRPC\Server;
use Spiral\RoadRunner\Worker;
use Spiral\Router\Annotation\Route;

class AuthController
{
    #[Route(route: '/api/register', methods:['POST'])]
    public function register(ServerRequestInterface $request, InputManager $input): ResponseInterface
    {
        $test = "Server running on 127.0.0.1:9004";
        return $this->jsonResponse(['kaveh' => $test]);
    }

    private function jsonResponse(array $data, int $status = 200): ResponseInterface
    {
        $response = new \Nyholm\Psr7\Response($status);
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }

}
