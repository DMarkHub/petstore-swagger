<?php

namespace App\DTO;

use App\Interfaces\DTOInterface;

class TagDTO implements DTOInterface
{
    public function __construct(
        public int $id,
        public string $name
    ) {

    }
}