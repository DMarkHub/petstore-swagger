<?php

namespace App\DTO;

use App\Enum\OrderStatus;
use App\Interfaces\DTOInterface;
use App\Interfaces\PrintableInterface;
use App\Traits\PrintableTrait;

class OrderDTO implements DTOInterface, PrintableInterface
{
    use PrintableTrait;

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