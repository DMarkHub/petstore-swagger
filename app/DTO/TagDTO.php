<?php

namespace App\DTO;

class TagDTO
{
    public function __construct(
        public int $id,
        public string $name
    ) {

    }
}