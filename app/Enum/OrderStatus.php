<?php

namespace App\Enum;

enum OrderStatus: string
{
    case Placed = 'placed';
    case Approved = 'approved';
    case Delivered = 'delivered';
}