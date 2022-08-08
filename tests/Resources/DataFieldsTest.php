<?php

namespace Dotdigital\Tests\Resources;

use Dotdigital\Resources\DataFields;
use Dotdigital\Tests\ApiConfigurationTrait;
use PHPUnit\Framework\TestCase;

class DataFieldsTest extends TestCase
{
    use ApiConfigurationTrait;

    protected string $resourceBase = DataFields::RESOURCE_BASE;

    public function setUp(): void
    {
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
