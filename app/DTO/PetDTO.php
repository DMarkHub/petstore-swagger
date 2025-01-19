<?php

namespace App\DTO;

use App\DTO\CategoryDTO;
use App\Enum\PetStatus;

class PetDTO
{
    public function __construct(
        public int $id,
        public CategoryDTO $category,
        public string $name,
        public string $photoUrls,
        public array $tags,
        public PetStatus $status,
    ) {

    }
}