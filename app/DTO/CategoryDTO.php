<?php

namespace App\DTO;

use App\Interfaces\DTOInterface;

class CategoryDTO implements DTOInterface
{
    public function __construct(
        public int $id,
        public string $name
    ) {

    }
}
