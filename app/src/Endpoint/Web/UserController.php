<?php

namespace App\Endpoint\Web;

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
        try {
            $userRequest = new CreateUserRequest([
                'first_name' => $input->data('first_name'),
                'last_name' => $input->data('last_name'),
                'mobile' => $input->data('mobile'),
                'password' => $input->data('password'),
                'email' => $input->data('email'),
                'birth_date' => $input->data('birth_date'),
                'father_name' => $input->data('father_name', ''),
                'national_code' => $input->data('national_code'),
                'picture' => $input->data('picture', ''),
            ]);

            $userResponse = $this->userService->Create(
                $userRequest,
                CreateUserResponse::class
            );


            $userResidentRequest = [
                'user' => $userResponse->id,
                'address' => $input->data('address') ?? '',
                'postal_code' => $input->data('postal_code') ?? '',
                'province' => $input->data('province_id') ?? '',
                'city' => $input->data('city_id') ?? '',
                'postal_code_file' => $input->data('postal_code_file') ?? '',
            ];

            $this->userService->CreateResident(
                new CreateUserResidentRequest(array_filter($userResidentRequest, fn($value) => $value !== '')),
                CreateUserResidentResponse::class
            );

            $userEducationRequest = [
                'user' => $userResponse->id,
                'university' => $input->data('university') ?? '',
                'degree' => $input->data('degree') ?? '',
                'education_file' => $input->data('education_file') ?? '',
            ];

            $this->userService->CreateEducation(
                new CreateUserEducationRequest(array_filter($userEducationRequest, fn($value) => $value !== '')),
                CreateUserEducationResponse::class
            );

            $userJobRequest = [
                'user' => $userResponse->id,
                'province' => $input->data('province') ?? '',
                'city' => $input->data('city') ?? '',
                'title' => $input->data('title') ?? '',
                'phone' => $input->data('phone') ?? '',
                'postal_code' => $input->data('postal_code') ?? '',
                'address' => $input->data('address') ?? '',
                'monthly_salary' => $input->data('monthly_salary') ?? '',
                'work_experience_duration' => $input->data('work_experience_duration') ?? '',
                'work_type' => $input->data('work_type') ?? '',
                'contract_type' => $input->data('contract_type') ?? '',
            ];

            $this->userService->CreateJob(
                new CreateUserJobRequest(array_filter($userJobRequest, fn($value) => $value !== '')),
                CreateUserJobResponse::class
            );

            return $this->jsonResponse([
                'user_id' => $userResponse->id,
                'message' => $userResponse->message,
            ]);
        } catch (\Exception $e) {
            return $this->jsonResponse([
                'error' => 'An error occurred during registration',
                'details' => $e->getMessage(),
            ], 500);
        }
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
