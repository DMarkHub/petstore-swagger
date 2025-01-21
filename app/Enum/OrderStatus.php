<?php

namespace App\Enum;

use App\Traits\EnumToArrayTrait;

enum OrderStatus: string
{
    use EnumToArrayTrait;

    case Placed = 'placed';
    case Approved = 'approved';
    case Delivered = 'delivered';
}