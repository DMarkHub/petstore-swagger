<?php

namespace App\Enum;

use App\Traits\EnumToArrayTrait;

enum PetStatus: string
{
    use EnumToArrayTrait;

    case Available = 'available';
    case Pending = 'pending';
    case Sold = 'sold';
}