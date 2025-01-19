<?php

namespace App\Http\Clients;

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

    }

    public function prepareUrl(string $pattern, ?array $params = null)
    {
        $resolved = $params === null ? $pattern : sprintf($pattern, ...$params);

        return sprintf('%s%s', $this->url, $resolved);
    }

    public function getUserByUsername(string $username): Response
    {
        return $this->httpClient->get($this->prepareUrl(UserApIUrl::User->value, [$username]));
    }
}