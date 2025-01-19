<?php

namespace App\Factories;

use App\DTO\ApiResponseDTO;
use App\Helpers\ApiResonseHelper;
use App\Interfaces\FromArrayFactoryInterface;
use Illuminate\Http\Client\Response;

class ApiResponseDTOFactory implements FromArrayFactoryInterface
{
    public function __construct(
        private ApiResonseHelper $apiResonseHelper
    ) {

    }

    public function create(?int $code, ?string $type, ?string $message): ApiResponseDTO
    {
        return new ApiResponseDTO($code, $type, $message);
    }

    public function createFromArray(array $input): ?ApiResponseDTO
    {
        $params = [
            $this->apiResonseHelper->filterIntFromArray($input, 'code'),
            $this->apiResonseHelper->filterStringFromArray($input, 'type'),
            $this->apiResonseHelper->filterStringFromArray($input, 'message')
        ];

        if (in_array(null, $params, true)) {
            return null;
        }

        return $this->create(...$params);
    }
}