<?php

declare(strict_types=1);

namespace GRPC\UserManagement;

/**
 * @method Create(CreateUserRequest $request, string $responseClass, array $context = [])
 * @method Update(UpdateUserRequest $request, string $responseClass, array $context = [])
 */
class UserManagementUserGrpcClient extends UserGrpcClient
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
