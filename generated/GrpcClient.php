<?php

namespace GRPC;

use App\Domain\DataTransferObject\UserResponseDTO;
use Spiral\RoadRunner\GRPC\Context;
use Spiral\RoadRunnerBridge\GRPC\Interceptor\ServiceClientCore;
use stdClass;

abstract class GrpcClient
{
    public function __construct(
        private readonly ServiceClientCore $core,
    )
    {
    }

    abstract public function getServiceInterface(): string;

    abstract public function getServiceName(): string;

    public function __call(string $name, array $arguments): UserResponseDTO
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

        if (null !== $response) {
            return new UserResponseDTO($response->getId(), $response->getMessage());
        }


        return new UserResponseDTO($detail->code, $detail->details);

    }

}

