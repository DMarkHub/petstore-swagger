<?php

namespace App\DTO;

class ApiResponseDTO
{
    public function __construct(
        public ?int $code,
        public ?string $type,
        public ?string $message
    ) {

    }
}