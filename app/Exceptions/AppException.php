<?php

namespace App\Exceptions;

use App\DTO\ApiResponseDTO;
use Exception;

class AppException extends Exception
{
    public $apiResponseDTO;

    public function __construct(
        ApiResponseDTO $apiResponseDTO
    ) {
        parent::__construct('', 0, null);

        $this->apiResponseDTO = $apiResponseDTO;
    }
}