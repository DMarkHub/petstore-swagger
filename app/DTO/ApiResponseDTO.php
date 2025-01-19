<?php

namespace App\DTO;

use App\Interfaces\DTOInterface;

class ApiResponseDTO implements DTOInterface
{
    public function __construct(
        public int $code,
        public string $type,
        public string $message
    ) {

    }
}