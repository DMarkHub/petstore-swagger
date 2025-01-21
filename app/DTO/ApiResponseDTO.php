<?php

namespace App\DTO;

use App\Interfaces\DTOInterface;
use App\Interfaces\PrintableInterface;
use App\Traits\PrintableTrait;

class ApiResponseDTO implements DTOInterface, PrintableInterface
{
    use PrintableTrait;

    public function __construct(
        public int $code,
        public string $type,
        public string $message
    ) {

    }
}