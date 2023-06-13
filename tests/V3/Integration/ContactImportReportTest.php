<?php

namespace Dotdigital\Tests\V3\Integration;

use Dotdigital\AbstractClient;
use Dotdigital\Tests\V3\Integration\TestCase as DotdigitalTestCase;
use Dotdigital\Tests\V3\Traits\InteractsWithContactTrait;
use Dotdigital\V3\Models\Contact\Import\Summary;

class ContactImportReportTest extends DotdigitalTestCase
{
    use InteractsWithContactTrait;

    /**
     * @var string
     */
    protected string $resourceBase = \Dotdigital\V3\Resources\Contacts::RESOURCE_BASE;

    /**
     * @var AbstractClient
     */
    protected AbstractClient $client;

    public function setUp(): void
    {
        parent::setUp();
        $this->testSuccessResponse();
    }

    public function testSuccessfulImport()
    {
        $importId = $this->client->contacts->import($this->generateContactCollection(200));
        $this->assertIsString($importId);
        return json_decode($importId)->importId;
    }

    /**
     * @depends testSuccessfulImport
     */
    public function testSuccessfulContactImportRetrievalById(string $importId)
    {
        $importReport = $this->client->contacts->getImportById($importId);
        $this->assertIsString($importId);
        $this->assertIsString($importReport->getImportId());
        $this->assertIsString($importReport->getStatus());
    }
}
