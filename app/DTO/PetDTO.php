<?php

namespace App\DTO;

use App\DTO\CategoryDTO;
use App\Enum\PetStatus;
use App\Interfaces\DTOInterface;
use App\Interfaces\PrintableInterface;
use App\Traits\PrintableTrait;

class PetDTO implements DTOInterface, PrintableInterface
{
    use PrintableTrait;

    public function __construct(
        public int $id,
        public CategoryDTO $category,
        public string $name,
        public array $photoUrls,
        public array $tags,
        public PetStatus $status,
    ) {

    }
}