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
}
