<?php

namespace Dotdigital\Tests;

use Dotdigital\AbstractClient;
use PHPUnit\Framework\Assert;

trait ApiConfigurationTrait
{
    /**
     * @var AbstractClient
     */
    protected AbstractClient $client;

    protected function clientInit(): void
    {
        $this->client::setApiUser('demo@apiconnector.com');
        $this->client::setApiPassword('demo');
        $this->client::setApiEndpoint('https://r1-api.dotmailer.com');
    }
}
