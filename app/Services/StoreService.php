<?php

namespace App\Services;

use App\DTO\OrderDTO;
use App\Factories\ApiResponseDTOFactory;
use App\Factories\OrderDTOFactory;
use App\Http\Clients\SwaggerHttpClient;
use App\Traits\ServiceTrait;
use DateTime;

class StoreService
{
    use ServiceTrait;

    public function __construct(
        private SwaggerHttpClient $swaggerHttpClient,
        private ApiResponseDTOFactory $apiResponseDTOFactory,
        private OrderDTOFactory $orderDTOFactory
    ) {

    }

    public function getInventory(): array
    {
        $inventory = [];
        $response = $this->swaggerHttpClient->getInventory();

        $this->checkResponse($response);

        $decodedJson = $response->json();

        foreach ($decodedJson as $key => $value) {
            $inventory[filter_var($key, FILTER_SANITIZE_FULL_SPECIAL_CHARS)] = (int) $value;
        }

        return $inventory;
    }

    public function getOrder(int $id): OrderDTO
    {
        $response = $this->swaggerHttpClient->getOrder($id);

        $this->checkResponse($response);

        $decodedJson = $response->json();

        return $this->orderDTOFactory->createFromArray($decodedJson);
    }

    public function createOrder(array $params): OrderDTO
    {
        $params['id'] = 0;
        $params['complete'] = $params['complete'] === 'on' ? 1 : 0;
        $params['shipDate'] = (new DateTime($params['shipDate']))->format('c');

        $order = $this->orderDTOFactory->createFromArray($params);
        $response = $this->swaggerHttpClient->createOrder($order);

        $this->checkResponse($response);

        $decodedJson = $response->json();

        return $this->orderDTOFactory->createFromArray($decodedJson);
    }

    public function deleteOrder(int $id): bool
    {
        $response = $this->swaggerHttpClient->deleteOrder($id);

        $this->checkResponse($response);

        $decodedJson = $response->json();

        return true;
    }
}