<?php

namespace App\Interfaces;

use App\Interfaces\DTOInterface;

interface FromArrayFactoryInterface
{
    public function createFromArray(array $input): ?DTOInterface;
}
