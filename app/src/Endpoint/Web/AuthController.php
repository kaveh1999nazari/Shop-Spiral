<?php

namespace App\Endpoint\Web;

use GRPC\UserManagement\CreateUserRequest;
use GRPC\UserManagement\UserManagementGrpcClient;
use GRPC\UserManagement\UserManagementGrpcInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Spiral\Http\Request\InputManager;
use Spiral\RoadRunner\GRPC\Context;
use Spiral\Router\Annotation\Route;

class AuthController
{

    public function __construct(private UserManagementGrpcClient $userService)
    {
    }

    #[Route(route: '/api/register', methods:['POST'])]
    public function register(ServerRequestInterface $request, InputManager $input): ResponseInterface
    {
        $requestClass = new CreateUserRequest([
            'first_name' => $input->data('first_name'),
            'last_name' => $input->data('last_name'),
            'mobile' => $input->data('mobile'),
            'password' => $input->data('password'),
            'email' => $input->data('email'),
            'birth_date' => $input->data('birth_date'),
            'father_name' => $input->data('father_name'),
            'national_code' => $input->data('national_code'),
            'picture' => $input->data('picture'),
        ]);

        try {
            $grpcResponse = $this->userService->Create(
                new Context([]),
                $requestClass
            );
        } catch (\Exception $e) {
            return $this->jsonResponse(['error' => $e->getMessage()], 500);
        }



        return $this->jsonResponse(['kaveh' => $requestClass->getEmail()]);
    }

    private function jsonResponse(array $data, int $status = 200): ResponseInterface
    {
        $response = new \Nyholm\Psr7\Response($status);
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }

}
