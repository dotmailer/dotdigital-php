<?php

namespace Dotdigital\Tests;

use Dotdigital\AbstractClient;
use PHPUnit\Framework\Assert;
use Symfony\Component\Dotenv\Dotenv;

trait ApiConfigurationTrait
{
    /**
     * @var AbstractClient
     */
    protected AbstractClient $client;

    protected function clientInit(): void
    {
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__.'/.env');

        $this->client::setApiUser($_ENV['DOTDIGITAL_API_USER']);
        $this->client::setApiPassword($_ENV['DOTDIGITAL_API_PASSWORD']);
        $this->client::setApiEndpoint($_ENV['DOTDIGITAL_API_ENDPOINT']);
    }
}
