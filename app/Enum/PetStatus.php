<?php

namespace App\Enum;

enum PetStatus: string
{
    case Available = 'available';
    case Pending = 'pending';
    case Sold = 'sold';
}