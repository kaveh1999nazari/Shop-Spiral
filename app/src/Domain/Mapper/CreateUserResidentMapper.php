<?php

namespace App\Domain\Mapper;

use GRPC\UserManagement\CreateUserResidentRequest;

class CreateUserResidentMapper
{

    public static function fromRequest(array $inputs, int $id): array
    {
        return [
            'user' => $id,
            'address' => $inputs['address'] ?? '',
            'postal_code' => $inputs['postal_code'] ?? '',
            'province' => $inputs['province_id'] ?? '',
            'city' => $inputs['city_id'] ?? '',
            'postal_code_file' => $inputs['postal_code_file'] ?? '',
        ];
    }
}
