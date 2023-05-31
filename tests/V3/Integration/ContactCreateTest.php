<?php

namespace Dotdigital\Tests\V3\Integration;

use Dotdigital\AbstractClient;
use Dotdigital\Exception\ResponseValidationException;
use Dotdigital\V3\Models\Contact;
use Dotdigital\V3\Resources\Contacts;

class ContactCreateTest extends TestCase
{
    protected string $resourceBase = Contacts::RESOURCE_BASE;

    protected AbstractClient $client;

    public function setUp(): void
    {
        parent::setUp();

        $this->testSuccessResponse();
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

    private function buildInvalidContact()
    {
        return new Contact(
            [
                'matchIdentifier' => 'email',
                'dataFields' => [
                    'firstName' => 'Chaznay',
                    'lastName' => 'Kangaroo',
                    'gender' => 'female'
                ],
                'consentRecords' => [
                    [
                        "text" => "Yes, I would like to receive a monthly newsletter",
                        "dateTimeConsented" => "2018-01-26T21:29:00",
                        "url" => "http://www.example.com/signup",
                        "ipAddress" => "129.168.0.2",
                        "userAgent" => "Mozilla/5.0 (X11; OpenBSD i386) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36"
                    ]
                ]
            ]
        );
    }

    private function buildContact()
    {
        return new Contact(
            [
                'matchIdentifier' => 'email',
                'identifiers' => [
                    'email' => bin2hex(random_bytes(16)) . '@emailsim.io'
                ],
                'dataFields' => [
                    'firstName' => 'Chaznay',
                    'lastName' => 'Kangaroo',
                    'gender' => 'female'
                ],
                'consentRecords' => [
                    [
                        "text" => "Yes, I would like to receive a monthly newsletter",
                        "dateTimeConsented" => "2018-01-26T21:29:00",
                        "url" => "http://www.example.com/signup",
                        "ipAddress" => "129.168.0.2",
                        "userAgent" => "Mozilla/5.0 (X11; OpenBSD i386) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36"
                    ]
                ]
            ]
        );
    }
}
