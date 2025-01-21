<?php

namespace App\Factories;

use App\DTO\CategoryDTO;
use App\Helpers\ApiResonseHelper;
use App\Interfaces\FromArrayFactoryInterface;

class CategoryDTOFactory implements FromArrayFactoryInterface
{
    public function __construct(
        private ApiResonseHelper $apiResonseHelper
    ) {

    }

    public function create(int $id, string $name): CategoryDTO
    {
        return new CategoryDTO($id, $name);
    }

    public function createFromArray(array $input): ?CategoryDTO
    {
        $id = $this->apiResonseHelper->filterIntFromArray($input, 'id');
        $name = $this->apiResonseHelper->filterStringFromArray($input, 'name');

        if (!isset($id, $name)) {
            return null;
        }

        return $this->create($id, $name);
    }
}