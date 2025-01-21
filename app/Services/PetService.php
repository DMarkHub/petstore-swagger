<?php

namespace App\Services;

use App\DTO\PetDTO;
use App\Factories\ApiResponseDTOFactory;
use App\Factories\PetDTOFactory;
use App\Http\Clients\SwaggerHttpClient;
use App\Traits\ServiceTrait;

class PetService
{
    use ServiceTrait;

    public function __construct(
        private SwaggerHttpClient $swaggerHttpClient,
        private ApiResponseDTOFactory $apiResponseDTOFactory,
        private PetDTOFactory $petDTOFactory
    ) {

    }

    public function getPetById(int $id): ?PetDTO
    {
        $response = $this->swaggerHttpClient->getPet($id);

        $this->checkResponse($response);

        $decodedJson = $response->json();

        return $this->petDTOFactory->createFromArray($decodedJson);
    }

    public function create(array $params): ?PetDTO
    {
        $params['id'] = 0;
        $params['category'] = ['id' => 0, 'name' => $params['category']];
        $params['tags'] = $this->tagsToArray($params['tags']);
        $params['photoUrls'] = $this->photosToArray($params['photoUrls']);

        $dto = $this->petDTOFactory->createFromArray($params);

        $response = $this->swaggerHttpClient->createPet($dto);

        $this->checkResponse($response);

        $decodedJson = $response->json();

        return $this->petDTOFactory->createFromArray($decodedJson);
    }

    public function update(array $params): ?PetDTO
    {
        $params['category'] = ['id' => 0, 'name' => $params['category']];
        $params['tags'] = $this->tagsToArray($params['tags']);
        $params['photoUrls'] = $this->photosToArray($params['photoUrls']);

        $dto = $this->petDTOFactory->createFromArray($params);

        $response = $this->swaggerHttpClient->updatePet($dto);

        $this->checkResponse($response);

        $decodedJson = $response->json();

        return $this->petDTOFactory->createFromArray($decodedJson);
    }

    private function tagsToArray(string $tags): array
    {
        return array_map(
            fn($tag) => ['id' => 0, 'name' => trim($tag)],
            explode(',', $tags)
        );
    }

    private function tagsToString(array $tags): string
    {
        return array_reduce($tags, function ($element) {
            return $element['name'];
        });
    }

    private function photosToArray(string $photos): array
    {
        return array_map(
            fn($photo) => trim($photo),
            explode(',', $photos)
        );
    }
}