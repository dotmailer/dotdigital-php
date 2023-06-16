<?php

namespace Dotdigital\Tests\V2\Integration\Resources;

use Dotdigital\AbstractClient;
use Dotdigital\Tests\ApiConfigurationTrait;
use Dotdigital\V2\Client;
use Dotdigital\V2\Resources\Contacts;
use PHPUnit\Framework\TestCase;

/**
 * @runTestsInSeparateProcesses
 * @coversDefaultClass \Dotdigital\V2\Resources\Contacts
 */
class ContactsTest extends TestCase
{
    use ApiConfigurationTrait;

    protected string $resourceBase = Contacts::RESOURCE_BASE;

    protected AbstractClient $client;

    public function setUp(): void
    {
        $this->client = new Client();
        $this->clientInit();
    }

    /**
     * @covers \Dotdigital\Resources\Contact::postContacts
     */
    public function testPostContactsType()
    {
        $contact = $this->client->contacts->postContacts('demo@apiconnector.com');
        $this->assertInstanceOf(\Dotdigital\V2\Models\Contact::class, $contact);
    }

    /**
     * @covers \Dotdigital\Resources\Contact::postContacts
     */
    public function testPostContactsValidation()
    {
        $this->expectException(\Dotdigital\Exception\ResponseValidationException::class);
        $this->client->contacts->postContacts('demo@apiconnector');
    }

    /**
     * @covers \Dotdigital\Resources\Contact::postContacts
     */
    public function testPostContactsContent()
    {
        $contact = $this->client->contacts->postContacts('test@apiconnector.com');
        $this->assertObjectHasProperty('id',$contact);
        $this->assertObjectHasProperty('email',$contact);
        $this->assertObjectHasProperty('optInType',$contact);
        $this->assertObjectHasProperty('emailType',$contact);
        $this->assertObjectHasProperty('dataFields',$contact);
        $this->assertObjectHasProperty('status',$contact);
    }

    /**
     * @covers \Dotdigital\Resources\Contact::resubscribe
     */
    public function testResubscribeType()
    {
        $contactList = $this->client->contacts->resubscribe('demo@apiconnector.com');
        $this->assertInstanceOf(\Dotdigital\V2\Models\ContactList::class, $contactList);
        foreach ($contactList->getList() as $contact) {
            $this->assertInstanceOf(\Dotdigital\V2\Models\Contact::class, $contact);
        }
    }

    /**
     * @covers \Dotdigital\Resources\Contact::resubscribe
     */
    public function testResubscribeValidation()
    {
        $this->expectException(\Dotdigital\Exception\ResponseValidationException::class);
        $this->client->contacts->resubscribe('demo@apiconnector');
    }

    /**
     * @covers \Dotdigital\Resources\Contact::resubscribe
     */
    public function testResubscribeContent()
    {
        $contactList = $this->client->contacts->resubscribe('demo@apiconnector.com');
        foreach ($contactList->getList() as $contact) {
            $this->assertObjectHasProperty('id',$contact);
            $this->assertObjectHasProperty('email',$contact);
            $this->assertObjectHasProperty('optInType',$contact);
            $this->assertObjectHasProperty('emailType',$contact);
            $this->assertObjectHasProperty('dataFields',$contact);
            $this->assertObjectHasProperty('status',$contact);
        }
    }

    /**
     * @covers \Dotdigital\Resources\Contact::getByEmail
     */
    public function testGetByEmailType()
    {
        $contact = $this->client->contacts->getByEmail('demo@apiconnector.com');
        $this->assertInstanceOf(\Dotdigital\V2\Models\Contact::class, $contact);

    }

    /**
     * @covers \Dotdigital\Resources\Contact::getByEmail
     */
    public function testGetByEmailValidation()
    {
        $this->expectException(\Dotdigital\Exception\ResponseValidationException::class);
        $this->client->contacts->getByEmail('demo@apiconnector');
    }

    /**
     * @covers \Dotdigital\Resources\Contact::getByEmail
     */
    public function testGetByEmailContent()
    {
        $contact = $this->client->contacts->getByEmail('demo@apiconnector.com');
        $this->assertObjectHasProperty('id',$contact);
        $this->assertObjectHasProperty('email',$contact);
        $this->assertObjectHasProperty('optInType',$contact);
        $this->assertObjectHasProperty('emailType',$contact);
        $this->assertObjectHasProperty('dataFields',$contact);
        $this->assertObjectHasProperty('status',$contact);
    }
}
