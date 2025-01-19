<?php

namespace App\DTO;

use App\Namespaces\DTOInterface;

class TagDTO implements DTOInterface
{
    public function __construct(
        public int $id,
        public string $name
    ) {

    }
}