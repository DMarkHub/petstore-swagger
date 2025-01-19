<?php

namespace App\Factories;

use App\DTO\TagDTO;
use App\Helpers\ApiResonseHelper;
use App\Interfaces\FromArrayFactoryInterface;

class TagDTOFactory implements FromArrayFactoryInterface
{
    public function __construct(
        private ApiResonseHelper $apiResonseHelper
    ) {

    }

    public function create(int $id, string $name): TagDTO
    {
        return new TagDTO($id, $name);
    }

    public function createFromArray(array $input): ?TagDTO
    {
        $id = $this->apiResonseHelper->filterIntFromArray($input, 'id');
        $name = $this->apiResonseHelper->filterStringFromArray($input, 'name');

        if (!isset($id, $name)) {
            return null;
        }

        return $this->create($id, $name);
    }
}