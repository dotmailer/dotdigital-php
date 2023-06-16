<?php

namespace Dotdigital\Tests\V2\Integration\Resources;

use Dotdigital\AbstractClient;
use Dotdigital\Tests\ApiConfigurationTrait;
use Dotdigital\V2\Client;
use Dotdigital\V2\Resources\DataFields;
use PHPUnit\Framework\TestCase;

class DataFieldsTest extends TestCase
{
    use ApiConfigurationTrait;

    protected string $resourceBase = DataFields::RESOURCE_BASE;

    protected AbstractClient $client;

    public function setUp(): void
    {
        $this->client = new Client();
        $this->clientInit();
    }

    public function testDataFieldsContent()
    {
        $dataFields = $this->client->dataFields->show();

        foreach ($dataFields->getList() as $dataField) {
            $this->assertTrue(property_exists($dataField, 'name'));
            $this->assertTrue(property_exists($dataField, 'type'));
            $this->assertTrue(property_exists($dataField, 'visibility'));
            $this->assertTrue(property_exists($dataField, 'defaultValue'));
        }
    }
}
