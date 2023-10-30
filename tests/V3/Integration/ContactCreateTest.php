<?php

namespace Dotdigital\Tests\V3\Integration;

use Dotdigital\AbstractClient;
use Dotdigital\Exception\ResponseValidationException;
use Dotdigital\V3\Models\Contact;
use Dotdigital\V3\Resources\Contacts;
use Dotdigital\Tests\V3\Traits\InteractsWithContactTrait;
use PHPUnit\Framework\Assert;

class ContactCreateTest extends TestCase
{
    use InteractsWithContactTrait;

    protected string $resourceBase = Contacts::RESOURCE_BASE;

    protected AbstractClient $client;

    /** @test */
    public function testSuccessResponse()
    {
        $response = $this->client->getHttpClient()->get($this->resourceBase);
        Assert::assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        Assert::assertEquals("application/json; charset=utf-8", $contentType);
    }

    /**
     * @return void
     */
    public function testSuccessfulContactCreate()
    {
        $contact = $this->buildContact();
        $contactResponse = $this->client->contacts->create($contact);

        $this->assertObjectHasProperty('contactId', $contactResponse);
        $this->assertObjectHasProperty('status', $contactResponse);
        $this->assertObjectHasProperty('created', $contactResponse);
        $this->assertObjectHasProperty('updated', $contactResponse);
        $this->assertObjectHasProperty('identifiers', $contactResponse);
        $this->assertObjectHasProperty('channelProperties', $contactResponse);
        $this->assertObjectHasProperty('dataFields', $contactResponse);
        $this->assertObjectHasProperty('consentRecords', $contactResponse);
    }

    public function testCreateInvalidContact()
    {
        $contact = $this->buildInvalidContact();
        $this->expectException(ResponseValidationException::class);
        $this->client->contacts->create($contact);
    }

    /** @test */
    public function testFailedResponse()
    {
        $this->client::setApiUser('invalid_ec_user');
        $this->client::setApiPassword('invalid_ec_password');
        $response = $this->client->getHttpClient()->get($this->resourceBase);;
        Assert::assertEquals(401, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        Assert::assertEquals("application/json; charset=utf-8", $contentType);
    }
}
