<?php

namespace App\Endpoint\Web;

use App\Domain\Mapper\CreateUserEducationMapper;
use App\Domain\Mapper\CreateUserJobMapper;
use App\Domain\Mapper\CreateUserMapper;
use App\Domain\Mapper\CreateUserResidentMapper;
use GRPC\UserManagement\CreateUserEducationRequest;
use GRPC\UserManagement\CreateUserEducationResponse;
use GRPC\UserManagement\CreateUserJobRequest;
use GRPC\UserManagement\CreateUserJobResponse;
use GRPC\UserManagement\CreateUserRequest;
use GRPC\UserManagement\CreateUserResidentRequest;
use GRPC\UserManagement\CreateUserResidentResponse;
use GRPC\UserManagement\CreateUserResponse;
use GRPC\UserManagement\UpdateUserRequest;
use GRPC\UserManagement\UpdateUserResponse;
use GRPC\UserManagement\UserManagementGrpcClient;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Spiral\Http\Request\InputManager;
use Spiral\Router\Annotation\Route;

class UserController
{

    public function __construct(private readonly UserManagementGrpcClient $userService)
    {
    }

    #[Route(route: '/api/register', methods: ['POST'])]
    public function register(ServerRequestInterface $request, InputManager $input): ResponseInterface
    {
        $userRequest = CreateUserMapper::fromRequest($input->data->all());

        $userResponse = $this->userService->Create(
                $userRequest,
                CreateUserResponse::class
        );

        $userResidentRequest = CreateUserResidentMapper::fromRequest($input->data->all(), $userResponse->id);

        $this->userService->CreateResident(
                new CreateUserResidentRequest(array_filter($userResidentRequest, fn($value) => $value !== '')),
                CreateUserResidentResponse::class
        );

        $userEducationRequest = CreateUserEducationMapper::fromRequest($input->data->all(), $userResponse->id);

        $this->userService->CreateEducation(
                new CreateUserEducationRequest(array_filter($userEducationRequest, fn($value) => $value !== '')),
                CreateUserEducationResponse::class
        );

        $userJobRequest = CreateUserJobMapper::fromRequest($input->data->all(), $userResponse->id);

        $this->userService->CreateJob(
                new CreateUserJobRequest(array_filter($userJobRequest, fn($value) => $value !== '')),
                CreateUserJobResponse::class
        );

        return $this->jsonResponse([
                'user_id' => $userResponse->id,
                'message' => $userResponse->message,
        ]);
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
