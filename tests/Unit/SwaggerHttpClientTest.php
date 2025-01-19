<?php

namespace Tests\Unit;

use App\Enum\UserApIUrl;
use App\Factories\ApiResponseDTOFactory;
use App\Http\Clients\SwaggerHttpClient;
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
}
