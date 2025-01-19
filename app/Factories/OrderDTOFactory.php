<?php

namespace App\Factories;

use App\Interfaces\ApiResonseFactoryInterface;
use App\DTO\OrderDTO;
use App\Enum\OrderStatus;
use App\Helpers\ApiResonseHelper;
use App\Namespaces\DTOInterface;
use Illuminate\Http\Client\Response;

class OrderDTOFactory implements ApiResonseFactoryInterface
{
    public function __construct(
        private ApiResonseHelper $apiResonseHelper
    ) {

    }

    public function create(int $id, int $petId, int $quantity, string $shipDate, OrderStatus $status, bool $complete)
    {
        return new OrderDTO($id, $petId, $quantity, $shipDate, $status, $complete);
    }

    public function createFromApiResponse(Response $response): ?DTOInterface
    {
        $body = $response->json();

        $params = [
            $this->apiResonseHelper->filterIntFromArray($body, 'id'),
            $this->apiResonseHelper->filterIntFromArray($body, 'petId'),
            $this->apiResonseHelper->filterIntFromArray($body, 'quantity'),
            $this->apiResonseHelper->filterStringFromArray($body, 'shipDate'),
            $this->apiResonseHelper->filterEnumFromArray($body, 'status', OrderStatus::cases()),
            $this->apiResonseHelper->filterBoolFromArray($body, 'complete'),
        ];

        return $this->create(...$params);
    }
}