<?php

namespace Dotdigital\Tests;

use Dotdigital\Client;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

trait ApiConfigurationTrait
{
    /**
     * @var Client
     */
    protected Client $client;

    protected function clientInit(): void
    {
        $this->client = new Client();
        $this->client::setApiUser('demo@apiconnector.com');
        $this->client::setApiPassword('demo');
        $this->client::setApiEndpoint('https://r1-api.dotmailer.com');
    }

    /** @test */
    public function testSuccessResponse()
    {
        $response = $this->client->getHttpClient()->get($this->resourceBase);
        Assert::assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        Assert::assertEquals("application/json; charset=utf-8", $contentType);
    }

    /** @test */
    public function testFailedResponse()
    {
        $this->client::setApiUser('invalid_ec_user');
        $this->client::setApiPassword('invalid_ec_password');
        $response = $this->client->getHttpClient()->get($this->resourceBase);;
        Assert::assertEquals(401, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        Assert::assertEquals("application/json; charset=utf-8", $contentType);
    }
}
