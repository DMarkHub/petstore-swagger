<?php

namespace Tests\Unit;

use App\DTO\ApiResponseDTO;
use App\DTO\CategoryDTO;
use App\DTO\PetDTO;
use App\Enum\UserApIUrl;
use App\Factories\ApiResponseDTOFactory;
use App\Http\Clients\SwaggerHttpClient;
use ReflectionClass;
use ReflectionProperty;
use Tests\TestCase;

class SwaggerHttpClientTest extends TestCase
{
    private SwaggerHttpClient $client;
    private ApiResponseDTOFactory $responseFactory;

    public function setUp(): void
    {
        parent::setUp();

        $this->client = app(SwaggerHttpClient::class);
        $this->responseFactory = app(ApiResponseDTOFactory::class);
    }

    /**
     * A basic unit test example.
     */
    public function testPrepareUrl(): void
    {
        $apiUrl = config('services.swagger.url');

        $url = $this->client->prepareUrl(UserApIUrl::User->value, ['username']);

        $this->assertEquals(
            sprintf(
                '%s%s',
                $apiUrl,
                sprintf(UserApIUrl::User->value, 'username')
            ),
            $url
        );
    }

    public function getNotFoundUserByUsername(): void
    {
        $response = $this->client->getUserByUsername('oqwejnaiuysrqkjqiwuasdb');

        $actual = $this->responseFactory->createFromApiResponse($response);
        $expected = $this->responseFactory->create(1, 'error', 'User not found');

        $this->assertEquals($expected, $actual);
        $this->assertEquals(404, $response->getStatusCode());

    }

    public function testReflection(): void
    {
        $data = ['code' => 1, 'type' => 'error', 'message' => 'User not found'];

        $reflection = new ReflectionClass(PetDTO::class);
        $properties = [];

        foreach ($reflection->getProperties() as $item) {
            $data = ['class' => $item->class];
            $property = new ReflectionProperty($item->class, $item->name);
            var_dump($property->getType()->getName());
            var_dump($property->getType()->isBuiltin());

            if ($property->getType()->isBuiltin()) {

            }

            $properties[$item->name] = $data;
        }

        // var_dump($properties);
        // var_dump($reflection->getProperty('name'));

        $this->assertEquals(1, 1);

    }
}
