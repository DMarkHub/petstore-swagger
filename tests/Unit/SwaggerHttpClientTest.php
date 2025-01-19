<?php

namespace Tests\Unit;

use App\Enum\UserApIUrl;
use App\Http\Clients\SwaggerHttpClient;
use Tests\TestCase;

class SwaggerHttpClientTest extends TestCase
{
    private SwaggerHttpClient $client;

    public function setUp(): void
    {
        parent::setUp();

        $this->client = app(SwaggerHttpClient::class);
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

    public function testGetUserByUsername(): void
    {
        $response = $this->client->getUserByUsername('oqwejnaiuysrqkjqiwuasdb');

        $this->assertEquals(['code' => 1, 'type' => 'error', 'message' => 'User not found'], $response->json());
        $this->assertEquals(404, $response->getStatusCode());

    }
}
