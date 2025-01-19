<?php

namespace App\Interfaces;

use App\Interfaces\DTOInterface;
use Illuminate\Http\Client\Response;

interface ApiResonseFactoryInterface
{
    public function createFromApiResponse(Response $response): ?DTOInterface;
}
