<?php

declare(strict_types=1);

namespace GRPC\UserManagement;

use Spiral\Core\InterceptableCore;
use Spiral\RoadRunner\GRPC\ContextInterface;

class UserManagementGrpcClient implements UserManagementGrpcInterface
{
    public function __construct(
        private readonly InterceptableCore $core,
    ) {
    }

    public function Create(ContextInterface $ctx, CreateUserRequest $in): CreateUserResponse
    {
        [$response, $status] = $this->core->callAction(UserManagementGrpcInterface::class, '/'.self::NAME.'/Create', [
            'in' => $in,
            'ctx' => $ctx,
            'responseClass' => \GRPC\UserManagement\CreateUserResponse::class,
        ]);

        return $response;
    }

    public function Update(ContextInterface $ctx, UpdateUserRequest $in): UpdateUserResponse
    {
        [$response, $status] = $this->core->callAction(UserManagementGrpcInterface::class, '/'.self::NAME.'/Update', [
            'in' => $in,
            'ctx' => $ctx,
            'responseClass' => \GRPC\UserManagement\UpdateUserResponse::class,
        ]);

        return $response;
    }
}
