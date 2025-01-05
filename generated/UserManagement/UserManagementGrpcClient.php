<?php

declare(strict_types=1);

namespace GRPC\UserManagement;

/**
 * @method Create(CreateUserRequest $request, string $responseClass, array $context = [])
 * @method Update(UpdateUserRequest $request, string $responseClass, array $context = [])
 */
class UserManagementGrpcClient extends GrpcClient
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
