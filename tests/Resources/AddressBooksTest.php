<?php

namespace Dotdigital\Tests\Resources;

use Dotdigital\Resources\AccountInfo;
use PHPUnit\Framework\TestCase;
use Dotdigital\Tests\ApiConfigurationTrait;

class AddressBooksTest extends TestCase
{
    use ApiConfigurationTrait;

    protected string $resourceBase = AccountInfo::RESOURCE_BASE;

    public function setUp(): void
    {
        $this->clientInit();
        $this->testSuccessResponse();
    }

    public function testAddressBooksContent()
    {
        $addressBooks = $this->client->addressBooks->show();
        foreach ($addressBooks as $addressBook) {
            $this->assertObjectHasAttribute('id', $addressBook);
            $this->assertObjectHasAttribute('name', $addressBook);
            $this->assertObjectHasAttribute('visibility', $addressBook);
            $this->assertObjectHasAttribute('contacts', $addressBook);
        }
    }

    public function tearDown(): void
    {
        $this->testFailedResponse();
    }
}
