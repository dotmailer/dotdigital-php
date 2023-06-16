<?php

namespace Dotdigital\Tests\V2\Integration\Resources;

use Dotdigital\AbstractClient;
use Dotdigital\Tests\ApiConfigurationTrait;
use Dotdigital\V2\Client;
use Dotdigital\V2\Resources\AccountInfo;
use PHPUnit\Framework\TestCase;

class AddressBooksTest extends TestCase
{
    use ApiConfigurationTrait;

    protected string $resourceBase = AccountInfo::RESOURCE_BASE;

    protected AbstractClient $client;

    public function setUp(): void
    {
        $this->client = new Client();
        $this->clientInit();
    }

    public function testAddressBooksContent()
    {
        $addressBooks = $this->client->addressBooks->show();
        foreach ($addressBooks->getList() as $addressBook) {
            $this->assertTrue(property_exists($addressBook, 'id'));
            $this->assertTrue(property_exists($addressBook, 'name'));
            $this->assertTrue(property_exists($addressBook, 'visibility'));
            $this->assertTrue(property_exists($addressBook, 'contacts'));
        }
    }
}
