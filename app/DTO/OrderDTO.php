<?php

namespace App\DTO;

use App\Enum\OrderStatus;
use App\Interfaces\DTOInterface;

class OrderDTO implements DTOInterface
{
    public function __construct(
        public int $id,
        public int $petId,
        public int $quantity,
        public string $shipDate,
        public OrderStatus $status,
        public bool $complete
    ) {

    }
}