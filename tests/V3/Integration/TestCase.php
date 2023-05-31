<?php

namespace Dotdigital\Tests\V3\Integration;

use Dotdigital\AbstractClient;
use Dotdigital\V3\Client;
use PHPUnit\Framework\Assert;
use Symfony\Component\Dotenv\Dotenv;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @var AbstractClient
     */
    protected AbstractClient $client;

    public function setUp(): void
    {
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__.'/.env');

        $this->client = new Client();
        $this->clientInit();
    }

    protected function clientInit(): void
    {
        $this->client::setApiUser($_ENV['DOTDIGITAL_API_USER']);
        $this->client::setApiPassword($_ENV['DOTDIGITAL_API_PASSWORD']);
        $this->client::setApiEndpoint($_ENV['DOTDIGITAL_API_ENDPOINT']);
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
