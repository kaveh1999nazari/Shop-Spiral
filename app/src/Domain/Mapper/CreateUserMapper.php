<?php

namespace App\Domain\Mapper;

use GRPC\UserManagement\CreateUserRequest;

class CreateUserMapper
{

    public static function fromRequest(array $inputs): CreateUserRequest
    {
        return new CreateUserRequest([
            'first_name' => $inputs['first_name'] ?? null,
            'last_name' => $inputs['last_name'] ?? null,
            'mobile' => $inputs['mobile'] ?? null,
            'password' => $inputs['password'] ?? null,
            'email' => $inputs['email'] ?? null,
            'birth_date' => $inputs['birth_date'] ?? null,
            'father_name' => $inputs['father_name'] ?? '',
            'national_code' => $inputs['national_code'] ?? null,
            'picture' => $inputs['picture'] ?? '',
        ]);
    }

}
