<?php

namespace App\Domain\Mapper;

class CreateUserEducationMapper
{

    public static function fromRequest(array $inputs, int $id): array
    {
        return [
            'user' => $id,
            'university' => $inputs['university'] ?? '',
            'degree' => $inputs['degree'] ?? '',
            'education_file' => $inputs['education_file'] ?? '',
        ];

    }

}
