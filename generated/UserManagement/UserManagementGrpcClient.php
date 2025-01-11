<?php

declare(strict_types=1);

namespace GRPC\UserManagement;

use GRPC\UserManagement\UserGrpcClient;
use GRPC\UserManagement\UserManagementGrpcInterface;

/**
 * @method Create(CreateUserRequest $request, string $responseClass, array $context = [])
 * @method CreateResident(CreateUserResidentRequest $request, $responseClass, $context = [])
 * @method CreateEducation(CreateUserEducationRequest $request, $responseClass, $context = [])
 * @method CreateJob(CreateUserJobRequest $request, $responseClass, $context = [])
 * @method Update(UpdateUserRequest $request, string $responseClass, array $context = [])
 */
class UserManagementGrpcClient extends UserGrpcClient
{
    public function getServiceInterface(): string
    {
        return UserManagementGrpcInterface::class;
    }

    public function getServiceName(): string
    {
        return UserManagementGrpcInterface::NAME;
    }
}
