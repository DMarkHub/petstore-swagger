<?php

namespace App\Factories;

use App\DTO\OrderDTO;
use App\Enum\OrderStatus;
use App\Helpers\ApiResonseHelper;
use App\Interfaces\DTOInterface;
use App\Interfaces\FromArrayFactoryInterface;
use Illuminate\Http\Client\Response;

class OrderDTOFactory implements FromArrayFactoryInterface
{
    public function __construct(
        private ApiResonseHelper $apiResonseHelper
    ) {

    }

    public function create(?int $id, ?int $petId, ?int $quantity, ?string $shipDate, ?OrderStatus $status, ?bool $complete): OrderDTO
    {
        return new OrderDTO($id, $petId, $quantity, $shipDate, $status, $complete);
    }

    public function createFromArray(array $input): ?DTOInterface
    {
        $params = [
            $this->apiResonseHelper->filterIntFromArray($input, 'id'),
            $this->apiResonseHelper->filterIntFromArray($input, 'petId'),
            $this->apiResonseHelper->filterIntFromArray($input, 'quantity'),
            $this->apiResonseHelper->filterStringFromArray($input, 'shipDate'),
            $this->apiResonseHelper->filterEnumFromArray($input, 'status', OrderStatus::class),
            $this->apiResonseHelper->filterBoolFromArray($input, 'complete'),
        ];

        if (in_array(null, $params, true)) {
            return null;
        }

        return $this->create(...$params);
    }
}