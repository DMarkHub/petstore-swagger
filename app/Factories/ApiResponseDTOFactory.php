<?php

namespace App\Factories;

use App\ApiResonseFactoryInterface;
use App\DTO\ApiResponseDTO;
use App\Helpers\ApiResonseHelper;
use Illuminate\Http\Client\Response;
use ReflectionClass;

class ApiResponseDTOFactory implements ApiResonseFactoryInterface
{
    public function __construct(
        private ApiResonseHelper $apiResonseHelper
    ) {

    }

    public function create(?int $code, ?string $type, ?string $message): ApiResponseDTO
    {
        return new ApiResponseDTO($code, $type, $message);
    }

    public function createFromApiResponse(Response $response): ApiResponseDTO
    {
        $body = $response->json();

        return $this->create(
            $this->apiResonseHelper->filterIntFromArray($body, 'code'),
            $this->apiResonseHelper->filterStringFromArray($body, 'type'),
            $this->apiResonseHelper->filterStringFromArray($body, 'message')
        );
    }
}