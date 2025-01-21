<?php

namespace App\Services;

use App\DTO\ApiResponseDTO;
use App\DTO\UserDTO;
use App\Factories\ApiResponseDTOFactory;
use App\Factories\UserDTOFactory;
use App\Http\Clients\SwaggerHttpClient;
use App\Traits\ServiceTrait;

class UserService
{
    use ServiceTrait;

    public function __construct(
        private SwaggerHttpClient $swaggerHttpClient,
        private ApiResponseDTOFactory $apiResponseDTOFactory,
        private UserDTOFactory $userDTOFactory
    ) {

    }

    public function createUser(array $params): ApiResponseDTO
    {
        $params['id'] = 0;

        $user = $this->userDTOFactory->createFromArray($params);
        $response = $this->swaggerHttpClient->createUser($user);

        $this->checkResponse($response);

        $decodedJson = $response->json();

        return $this->apiResponseDTOFactory->createFromArray($decodedJson);
    }

    public function createUsers(array $json): ApiResponseDTO
    {
        $response = $this->swaggerHttpClient->createUsers($json);

        $this->checkResponse($response);

        $decodedJson = $response->json();

        return $this->apiResponseDTOFactory->createFromArray($decodedJson);
    }

    public function updateUser(string $username, array $params): ApiResponseDTO
    {
        $user = $this->userDTOFactory->createFromArray($params);
        $response = $this->swaggerHttpClient->updateUser($username, $user);

        $this->checkResponse($response);

        $decodedJson = $response->json();

        return $this->apiResponseDTOFactory->createFromArray($decodedJson);
    }

    public function deleteUser(string $username): ApiResponseDTO
    {
        $response = $this->swaggerHttpClient->deleteUser($username);

        $this->checkResponse($response);

        $decodedJson = $response->json();

        return $this->apiResponseDTOFactory->createFromArray($decodedJson);
    }

    public function getUserByUsername(string $username): UserDTO
    {
        $response = $this->swaggerHttpClient->getUserByUsername($username);

        $this->checkResponse($response);

        $decodedJson = $response->json();

        return $this->userDTOFactory->createFromArray($decodedJson);
    }

    public function loginUser(string $username, string $password): ApiResponseDTO
    {
        $response = $this->swaggerHttpClient->loginUser($username, $password);

        $this->checkResponse($response);

        $decodedJson = $response->json();

        return $this->apiResponseDTOFactory->createFromArray($decodedJson);
    }

    public function login(UserDTO $user): void
    {
        session()->put('user', json_encode($user));
    }

    public function logout(): void
    {
        session()->forget('user');
    }

    public function getUser(): ?UserDTO
    {
        $user = json_decode(session('user'), true);

        if ($user) {
            return $this->userDTOFactory->createFromArray($user);
        }

        return null;
    }
}