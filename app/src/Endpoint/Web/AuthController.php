<?php

namespace App\Endpoint\Web;

use GRPC\authentication\AuthenticationUserGrpcClient;
use GRPC\authentication\LoginEmailRequest;
use GRPC\authentication\LoginEmailResponse;
use GRPC\authentication\LoginMobileRequest;
use GRPC\authentication\LoginMobileResponse;
use GRPC\authentication\LogoutRequest;
use GRPC\authentication\LogoutResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Spiral\Http\Request\InputManager;
use Spiral\RoadRunner\GRPC\Context;
use Spiral\Router\Annotation\Route;

class AuthController
{

    public function __construct(private readonly AuthenticationUserGrpcClient $authenticationService)
    {
    }

    #[Route(route: '/api/auth/login-mobile', methods: ['POST'])]
    public function loginByMobile(ServerRequestInterface $request, InputManager $input): ResponseInterface
    {
        $requestClass = new LoginMobileRequest([
            'mobile' => $input->data('mobile'),
            'password' => $input->data('password'),
        ]);

        $response = $this->authenticationService->LoginByMobile(
            $requestClass,
            LoginMobileResponse::class
        );

        return $this->jsonResponse(['token' => $response->token,
                                    'message' => $response->message]);

    }

    #[Route(route: '/api/auth/login-email', methods: ['POST'])]
    public function loginByEmail(ServerRequestInterface $request, InputManager $input): ResponseInterface
    {
        $requestClass = new LoginEmailRequest([
            'email' => $input->data('email'),
            'code' => $input->data('code'),
        ]);

        $response = $this->authenticationService->LoginByEmail(
            $requestClass,
            LoginEmailResponse::class
        );

        return $this->jsonResponse(['token' => $response->token,
                                    'message' => $response->message]);

    }

    //todo fix context for token
    #[Route(route: '/api/auth/logout', methods: ['POST'])]
    public function logout(ServerRequestInterface $request, InputManager $input): ResponseInterface
    {
        $authorizationHeader = $request->getHeader('Authorization');

        if ($authorizationHeader === null) {
            return $this->jsonResponse(['message' => 'Invalid or missing token.'], 400);
        }

        $response = $this->authenticationService->logout(
            new LogoutRequest(),
            LogoutResponse::class,
            ['authorization' => $authorizationHeader[0]]
        );

        return $this->jsonResponse(['message' => $response->message]);
    }

    private function jsonResponse(array $data, int $status = 200): ResponseInterface
    {
        $response = new \Nyholm\Psr7\Response($status);
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
