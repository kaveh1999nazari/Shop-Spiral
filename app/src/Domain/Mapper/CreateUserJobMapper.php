<?php

namespace App\Domain\Mapper;

class CreateUserJobMapper
{
    public static function fromRequest(array $inputs, int $id): array
    {
        return [
            'user' => $id,
            'province' => $inputs['province'] ?? '',
            'city' => $inputs['city'] ?? '',
            'title' => $inputs['title'] ?? '',
            'phone' => $inputs['phone'] ?? '',
            'postal_code' => $inputs['postal_code'] ?? '',
            'address' => $inputs['address'] ?? '',
            'monthly_salary' => $inputs['monthly_salary'] ?? '',
            'work_experience_duration' => $inputs['work_experience_duration'] ?? '',
            'work_type' => $inputs['work_type'] ?? '',
            'contract_type' => $inputs['contract_type'] ?? '',
        ];

    }

}
