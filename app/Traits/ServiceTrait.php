<?php

namespace App\Traits;

use App\Exceptions\AppException;
use Illuminate\Http\Client\Response;

trait ServiceTrait
{
    public function checkResponse(Response $response)
    {
        if ($response->getStatusCode() === 200) {
            return;
        }

        $decodedJson = $response->json();
        $message = $this->apiResponseDTOFactory->createFromArray($decodedJson);

        if ($message) {
            throw new AppException($message);
        }
    }
}