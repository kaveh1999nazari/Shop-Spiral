<?php

namespace App\Endpoint\Web;

use GRPC\UserManagement\CreateUserRequest;
use GRPC\UserManagement\CreateUserResponse;
use GRPC\UserManagement\UpdateUserRequest;
use GRPC\UserManagement\UpdateUserResponse;
use GRPC\UserManagement\UserManagementGrpcClient;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Spiral\Http\Request\InputManager;
use Spiral\Router\Annotation\Route;

class AuthController
{

    public function __construct(private readonly UserManagementGrpcClient $userService)
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

        $response = $this->userService->Create(
                $requestClass,
                CreateUserResponse::class
        );

        return $this->jsonResponse(['id' => $response->id,
                                    'message' => $response->message,]);
    }

    #[Route(route: '/api/update', methods:['POST'])]
    public function update(ServerRequestInterface $request, InputManager $input): ResponseInterface
    {
        $requestClass = new UpdateUserRequest([
            'user' => $input->data('user'),
            'first_name' => $input->data('first_name'),
            'last_name' => $input->data('last_name'),
            'mobile' => $input->data('mobile'),
            'password' => $input->data('password'),
            'email' => $input->data('email'),
            'birth_date' => $input->data('birth_date'),
            'father_name' => $input->data('father_name'),
            'national_code' => $input->data('national_code'),
            'picture' => $input->data('picture'),
            'code' => $input->data('code'),
        ]);

        $response = $this->userService->Update(
            $requestClass,
            UpdateUserResponse::class
        );

        return $this->jsonResponse(['id' => $response->id,
                                    'message' => $response->message,]);
    }

    private function jsonResponse(array $data, int $status = 200): ResponseInterface
    {
        $response = new \Nyholm\Psr7\Response($status);
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }

}
