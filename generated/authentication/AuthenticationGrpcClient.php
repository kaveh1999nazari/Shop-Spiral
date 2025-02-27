<?php

namespace GRPC\authentication;

use App\Domain\DataTransferObject\AuthResponseDTO;
use Spiral\RoadRunner\GRPC\Context;
use Spiral\RoadRunnerBridge\GRPC\Interceptor\ServiceClientCore;
use stdClass;

abstract class AuthenticationGrpcClient
{
    public function __construct(
        private readonly ServiceClientCore $core,
    )
    {
    }

    abstract public function getServiceInterface(): string;

    abstract public function getServiceName(): string;

    public function __call(string $name, array $arguments): AuthResponseDTO
    {
        /** @var stdClass $detail */
        /** @var object $response */
        [$response, $detail] = $this->core->callAction(
            $this->getServiceInterface(),
            '/' . $this->getServiceName() . '/' . $name,
            [
                'in' => $arguments[0],
                'responseClass' => $arguments[1],
                'ctx' => new Context($arguments[2] ?? []),
            ],
        );

        /**
         * getMessage is repeated string in proto type
         * we must implode the array
         */
        if (null !== $response) {
            return new AuthResponseDTO(
                $response->getToken(),
                implode(', ', iterator_to_array($response->getMessage()))
            );
        }


        return new AuthResponseDTO($detail->code, $detail->details);

    }

}

