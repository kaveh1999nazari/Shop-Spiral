<?php

namespace App\Domain\DataTransferObject;

class AuthResponseDTO
{

    public function __construct(public string $token, public string $message)
    {
        $this->token = $token;
        $this->message = $message;
    }

}
