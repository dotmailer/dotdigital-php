<?php

namespace Dotdigital\Tests\V2\Integration\Resources;

use Dotdigital\AbstractClient;
use Dotdigital\Tests\ApiConfigurationTrait;
use Dotdigital\V2\Client;
use Dotdigital\V2\Resources\AccountInfo;
use PHPUnit\Framework\TestCase;

class AccountInfoTest extends TestCase
{
    use ApiConfigurationTrait;

    protected string $resourceBase = AccountInfo::RESOURCE_BASE;

    protected AbstractClient $client;

    public function setUp(): void
    {
        $this->client = new Client();
        $this->clientInit();
    }

    public function testAccountInfoContent()
    {
        $accountInfo = $this->client->accountInfo->show();
        $properties = $accountInfo->getProperties();
        /** @var array $property */
        foreach ($properties as $property) {
            $this->assertArrayHasKey('name', $property);
            $this->assertArrayHasKey('type', $property);
            $this->assertArrayHasKey('value', $property);
        }
    }
}
