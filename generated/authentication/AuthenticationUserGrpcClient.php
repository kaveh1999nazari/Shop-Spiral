<?php

declare(strict_types=1);

namespace GRPC\authentication;

use Spiral\Core\InterceptableCore;
use Spiral\RoadRunner\GRPC\ContextInterface;

class AuthenticationUserGrpcClient extends AuthenticationGrpcClient
{
    public function getServiceInterface(): string
    {
        return AuthenticationUserGrpcInterface::class;
    }

    public function getServiceName(): string
    {
        return AuthenticationUserGrpcInterface::NAME;
    }
}
