<?php

namespace App\Enum;

enum StoreApiUrl: string
{
    case GetInventory = '/store/inventory';
    case AddOrder = '/store/order';
    case GetOrder = '/store/order/%s';
    // case DeleteOrder = '/store/order/%s';
}