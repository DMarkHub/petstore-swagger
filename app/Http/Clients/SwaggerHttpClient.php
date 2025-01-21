<?php

namespace App\Http\Clients;

use App\DTO\OrderDTO;
use App\DTO\PetDTO;
use App\DTO\UserDTO;
use App\Enum\PetApiUrl;
use App\Enum\StoreApiUrl;
use App\Enum\UserApIUrl;
use Illuminate\Container\Attributes\Config;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Client\Factory;

class SwaggerHttpClient
{
    public function __construct(
        #[Config('services.swagger.url')] private string $url,
        private Factory $httpClient,
    ) {
        $this->httpClient->withHeader('Accept', 'application/json');
    }

    public function prepareUrl(string $pattern, ?array $params = null)
    {
        $resolved = $params === null ? $pattern : sprintf($pattern, ...$params);

        return sprintf('%s%s', $this->url, $resolved);
    }

    public function getInventory(): Response
    {
        return $this->httpClient->get(
            $this->prepareUrl(StoreApiUrl::GetInventory->value)
        );
    }

    public function getOrder(int $id): Response
    {
        return $this->httpClient->get(
            $this->prepareUrl(StoreApiUrl::GetOrder->value, [$id])
        );
    }

    public function createOrder(OrderDTO $order): Response
    {
        return $this->httpClient
            ->withHeader('Content-Type', 'application/json')
            ->post(
                $this->prepareUrl(StoreApiUrl::AddOrder->value),
                $order->printable()
            );
    }

    public function deleteOrder(int $id): Response
    {
        return $this->httpClient
            ->delete(
                $this->prepareUrl(StoreApiUrl::GetOrder->value, [$id])
            );
    }

    public function createUser(UserDTO $user): Response
    {
        return $this->httpClient
            ->withHeader('Content-Type', 'application/json')
            ->post(
                $this->prepareUrl(UserApIUrl::Create->value),
                $user->printable()
            );
    }

    public function createUsers(array $body): Response
    {
        return $this->httpClient
            ->withHeader('Content-Type', 'application/json')
            ->post(
                $this->prepareUrl(UserApIUrl::CreateWithArray->value),
                [json_encode($body)]
            );
    }

    public function updateUser(string $username, UserDTO $user): Response
    {
        return $this->httpClient
            ->withHeader('Content-Type', 'application/json')
            ->put(
                $this->prepareUrl(UserApIUrl::User->value, [$username]),
                $user->printable()
            );
    }

    public function deleteUser(string $username): Response
    {
        return $this->httpClient
            ->delete(
                $this->prepareUrl(UserApIUrl::User->value, [$username])
            );
    }

    public function getUserByUsername(string $username): Response
    {
        return $this->httpClient->get($this->prepareUrl(UserApIUrl::User->value, [$username]));
    }

    public function loginUser(string $username, string $password): Response
    {
        return $this->httpClient->get($this->prepareUrl(UserApIUrl::Login->value, [$username, $password]));
    }

    public function getPet(int $id): Response
    {
        return $this->httpClient->get(
            $this->prepareUrl(PetApiUrl::FindById->value, [$id])
        );
    }

    public function getPetsByStatus(string $query): Response
    {
        return $this->httpClient->get(
            $this->prepareUrl(PetApiUrl::FindByStatus->value, [$query])
        );
    }

    public function createPet(PetDTO $pet): Response
    {
        return $this->httpClient
            ->withHeader('Content-Type', 'application/json')
            ->post(
                $this->prepareUrl(PetApiUrl::Create->value),
                $pet->printable()
            );
    }

    public function updatePet(PetDTO $pet): Response
    {
        return $this->httpClient
            ->withHeader('Content-Type', 'application/json')
            ->put(
                $this->prepareUrl(PetApiUrl::Create->value),
                $pet->printable()
            );
    }
}