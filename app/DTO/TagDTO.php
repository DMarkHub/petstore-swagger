<?php

namespace App\DTO;

use App\Interfaces\DTOInterface;
use App\Interfaces\PrintableInterface;
use App\Traits\PrintableTrait;

class TagDTO implements DTOInterface, PrintableInterface
{
    use PrintableTrait;

    public function __construct(
        public int $id,
        public string $name
    ) {

    }
}