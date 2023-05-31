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

        foreach ($dataFields as $dataField) {
            $this->assertObjectHasAttribute('name', $dataField);
            $this->assertObjectHasAttribute('type', $dataField);
            $this->assertObjectHasAttribute('visibility', $dataField);
            $this->assertObjectHasAttribute('defaultValue', $dataField);
        }
    }

    public function tearDown(): void
    {
        $this->testFailedResponse();
    }
}
