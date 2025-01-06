<?php

declare(strict_types=1);

namespace GRPC\authentication;

use Spiral\Core\InterceptableCore;
use Spiral\RoadRunner\GRPC\ContextInterface;

class AuthenticationUserGrpcClient implements AuthenticationUserGrpcInterface
{
    public function __construct(
        private readonly InterceptableCore $core,
    ) {
    }

    public function LoginByMobile(ContextInterface $ctx, LoginMobileRequest $in): LoginMobileResponse
    {
        [$response, $status] = $this->core->callAction(AuthenticationUserGrpcInterface::class, '/'.self::NAME.'/LoginByMobile', [
            'in' => $in,
            'ctx' => $ctx,
            'responseClass' => \GRPC\authentication\LoginMobileResponse::class,
        ]);

        return $response;
    }

    public function LoginByEmail(ContextInterface $ctx, LoginEmailRequest $in): LoginEmailResponse
    {
        [$response, $status] = $this->core->callAction(AuthenticationUserGrpcInterface::class, '/'.self::NAME.'/LoginByEmail', [
            'in' => $in,
            'ctx' => $ctx,
            'responseClass' => \GRPC\authentication\LoginEmailResponse::class,
        ]);

        return $response;
    }

    public function logout(ContextInterface $ctx, LogoutRequest $in): LogoutResponse
    {
        [$response, $status] = $this->core->callAction(AuthenticationUserGrpcInterface::class, '/'.self::NAME.'/logout', [
            'in' => $in,
            'ctx' => $ctx,
            'responseClass' => \GRPC\authentication\LogoutResponse::class,
        ]);

        return $response;
    }
}
