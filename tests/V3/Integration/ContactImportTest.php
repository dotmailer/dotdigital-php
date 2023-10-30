<?php

namespace Dotdigital\Tests\V3\Integration;

use Dotdigital\AbstractClient;
use Dotdigital\Exception\ResponseValidationException;
use Dotdigital\V3\Models\Contact;
use Dotdigital\V3\Models\ContactCollection;
use Dotdigital\V3\Resources\Contacts;
use Dotdigital\Tests\V3\Traits\InteractsWithContactTrait;

/**
 * @runTestsInSeparateProcesses
 * @coversDefaultClass \Dotdigital\V3\Resources\Contacts
 */
class ContactImportTest extends TestCase
{
    use InteractsWithContactTrait;

    protected string $resourceBase = Contacts::RESOURCE_BASE;

    protected AbstractClient $client;

    public function testSuccessfulContactImport()
    {
        $contactCollection = $this->buildContactCollection();
        $importId = $this->client->contacts->import($contactCollection);

        $this->assertIsString($importId);
        return $importId;
    }

    public function testContactImportRequiresIdentifiers()
    {
        $contactCollection = $this->buildContactCollectionWithoutIdentifiers();

        $this->expectException(ResponseValidationException::class);
        $this->expectExceptionMessage('Internal server error');

        $this->client->contacts->import($contactCollection);
    }
}
