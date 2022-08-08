<?php

namespace Dotdigital\Tests\Resources;

use Dotdigital\Resources\AccountInfo;
use Dotdigital\Tests\ApiConfigurationTrait;
use PHPUnit\Framework\TestCase;

class AccountInfoTest extends TestCase
{
    use ApiConfigurationTrait;

    protected string $resourceBase = AccountInfo::RESOURCE_BASE;

    public function setUp(): void
    {
        $this->clientInit();
        $this->testSuccessResponse(AccountInfo::RESOURCE_BASE);
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

    public function tearDown(): void
    {
        $this->testFailedResponse();
    }
}
