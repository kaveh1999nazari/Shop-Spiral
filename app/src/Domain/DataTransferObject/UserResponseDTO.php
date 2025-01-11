<?php

namespace App\Domain\DataTransferObject;

class UserResponseDTO extends BaseDTO
{
    /**
     * @param int $id
     * @param string $message
     */
    public function __construct(public int $id, public string $message)
    {
        $this->id = $id;
        $this->message = $message;
    }

}
