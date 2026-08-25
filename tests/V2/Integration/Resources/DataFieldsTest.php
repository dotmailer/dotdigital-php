<?php

namespace Dotdigital\Tests\V2\Integration\Resources;

use Dotdigital\AbstractClient;
use Dotdigital\Enums\DataField\Type;
use Dotdigital\Enums\DataField\Visibility;
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

    public function testCreateDataFieldContent()
    {
        $name = 'SDKINT-' . strtoupper(uniqid());
        $expectedName = strtoupper(substr($name, 0, 20));
        $defaultValue = 'default-string-value';
        /** @var Type $type */
        $type = Type::from(Type::STRING);

        $dataField = $this->client->dataFields->create(
            $name,
            $type,
            null,
            $defaultValue
        );

        $this->assertSame($expectedName, $dataField->getName());
        $this->assertSame(Type::STRING, $dataField->getType());
        $this->assertSame(Visibility::PRIVATE, $this->getPropertyValue($dataField, 'visibility'));
        $this->assertSame($defaultValue, $this->getPropertyValue($dataField, 'defaultValue'));
    }

    private function getPropertyValue(object $object, string $property)
    {
        $reflection = new \ReflectionObject($object);
        $reflectionProperty = $reflection->getProperty($property);

        return $reflectionProperty->getValue($object);
    }
}
