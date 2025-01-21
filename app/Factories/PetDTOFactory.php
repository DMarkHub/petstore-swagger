<?php

namespace App\Factories;

use App\DTO\CategoryDTO;
use App\DTO\PetDTO;
use App\Enum\PetStatus;
use App\Helpers\ApiResonseHelper;
use App\Interfaces\DTOInterface;
use App\Interfaces\FromArrayFactoryInterface;

class PetDTOFactory implements FromArrayFactoryInterface
{
    public function __construct(
        private ApiResonseHelper $apiResonseHelper
    ) {

    }

    public function create(
        int $id,
        CategoryDTO $category,
        string $name,
        array $photoUrls,
        array $tags,
        PetStatus $status
    ): PetDTO {
        return new PetDTO(
            $id,
            $category,
            $name,
            $photoUrls,
            $tags,
            $status
        );
    }

    public function createFromArray(array $input): ?DTOInterface
    {
        $params = [
            $this->apiResonseHelper->filterIntFromArray($input, 'id'),
            $this->apiResonseHelper->filterCategoryFromArray($input, 'category'),
            $this->apiResonseHelper->filterStringFromArray($input, 'name'),
            $this->apiResonseHelper->filterPhotosFromArray($input, 'photoUrls', []),
            $this->apiResonseHelper->filterTagFromArray($input, 'tags', []),
            $this->apiResonseHelper->filterEnumFromArray($input, 'status', PetStatus::class),
        ];

        if (in_array(null, $params, true)) {
            return null;
        }

        return $this->create(...$params);
    }
}