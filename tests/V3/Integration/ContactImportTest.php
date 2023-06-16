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

    public function setUp(): void
    {
        parent::setUp();

        $this->testSuccessResponse();
    }

    public function testSuccessfulContactImport()
    {
        $contactCollection = $this->buildContactCollection();
        $importId = $this->client->contacts->import($contactCollection);

        $this->assertIsString($importId);
        return $importId;
    }

    /**
     * SNAG: currently omitting matchidentifier does not return an errorCode
     *
     * @return void
     */
    public function testContactImportRequiresMatchIdentifier()
    {
        $this->markTestSkipped('The endpoint does not treat a contact request as bad if it omits matchIdentifier.');
        $contactCollection = $this->buildContactCollectionWithoutMatchIdentifier();

        $this->expectException(ResponseValidationException::class);
        $this->expectExceptionMessage('The Matchidentifiers field is required.');

        $this->client->contacts->import($contactCollection);
    }

    public function testContactImportRequiresIdentifiers()
    {
        $contactCollection = $this->buildContactCollectionWithoutIdentifiers();

        $this->expectException(ResponseValidationException::class);
        $this->expectExceptionMessage('Internal server error');

        $this->client->contacts->import($contactCollection);
    }

    private function buildContactCollection()
    {
        $contact1 = new Contact(
            [
                'matchIdentifier' => 'email',
                'identifiers' => [
                    'email' => 'chaz0959@emailsim.io'
                ],
                'dataFields' => [
                    'FIRST_NAME' => 'Chaz',
                    'LAST_NAME' => 'Kangaroo',
                    'COMPANY' => 'Chaz Inc.'
                ],
                'lists' => [174867],
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
        $contact2 = new Contact(
            [
                'matchIdentifier' => 'mobileNumber',
                'identifiers' => [
                    'email' => 'chaz1702@emailsim.io',
                    'mobileNumber' => '44123123123'
                ],
                'dataFields' => [
                    'firstName' => 'Chaznay',
                    'lastName' => 'Kangaroo',
                    'gender' => 'female'
                ],
                'channelProperties' => [
                    'email' => [
                        'emailType' => 'Html',
                        'optInType' => 'Single'
                    ],
                    'sms' => [
                        'optInType' => 'Single'
                    ]
                ],
                'preferences' => [
                    [
                        'id' => 334,
                        'isOptedIn' => false
                    ]
                ],
            ]
        );
        $contact3 = new Contact(
            [
                'matchIdentifier' => 'email',
                'identifiers' => [
                    'email' => 'chaz1703@emailsim.io'
                ],
                'dataFields' => [
                    'firstName' => 'Chazzandra',
                    'lastName' => 'Kangaroo',
                    'gender' => 'female'
                ]
            ]
        );
        return new ContactCollection([
            $contact1,
            $contact2,
            $contact3
        ]);
    }

    private function buildContactCollectionWithoutMatchIdentifier()
    {
        $contact1 = new Contact(
            [
                'identifiers' => [
                    'email' => 'chaz1@emailsim.io'
                ]
            ]
        );

        return new ContactCollection([$contact1]);
    }

    private function buildContactCollectionWithoutIdentifiers()
    {
        $contact1 = new Contact(
            [
                'matchIdentifier' => 'email'
            ]
        );

        return new ContactCollection([$contact1]);
    }

}
