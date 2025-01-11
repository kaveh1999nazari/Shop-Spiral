<?php

declare(strict_types=1);

namespace GRPC\authentication;

use GRPC\UserManagement\CreateUserResidentRequest;
use Spiral\Core\InterceptableCore;
use Spiral\RoadRunner\GRPC\ContextInterface;

/**
 * @method LoginByMobile(LoginMobileRequest $request, $responseClass, $context = [])
 * @method LoginByEmail(LoginEmailRequest $request, $responseClass, $context = [])
 * @method Logout(LogoutRequest $request, $responseClass, $context = [])
 */
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
