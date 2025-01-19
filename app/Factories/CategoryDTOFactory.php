<?php

namespace App\Factories;

use App\ApiResonseFactoryInterface;
use App\DTO\CategoryDTO;
use App\Helpers\ApiResonseHelper;
use Illuminate\Http\Client\Response;

class CategoryDTOFactory implements ApiResonseFactoryInterface
{
    public function __construct(
        private ApiResonseHelper $apiResonseHelper
    ) {

    }

    public function create(int $id, string $name)
    {
        return new CategoryDTO($id, $name);
    }

    // TODO: remove
    public function createFromApiResponse(Response $response): ?CategoryDTO
    {
        $body = $response->json();

        $id = $this->apiResonseHelper->filterIntFromArray($body, 'id');
        $name = $this->apiResonseHelper->filterStringFromArray($body, 'name');

        if (!isset($id, $name)) {
            return null;
        }

        return $this->create($id, $name);
    }
}