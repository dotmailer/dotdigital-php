<?php

namespace Dotdigital\Tests\Resources;

use Dotdigital\Resources\Contacts;
use PHPUnit\Framework\TestCase;
use Dotdigital\Tests\ApiConfigurationTrait;

/**
 * @runTestsInSeparateProcesses
 * @coversDefaultClass \Dotdigital\Resources\Contacts
 */
class ContactsTest extends TestCase
{

    use ApiConfigurationTrait;

    protected string $resourceBase = Contacts::RESOURCE_BASE;

    public function setUp(): void
    {
        $this->clientInit();
        $this->testSuccessResponse();
    }

    /**
     * @covers \Dotdigital\Resources\Contact::postContacts
     */
    public function testPostContactsType()
    {
        $contact = $this->client->contacts->postContacts('demo@apiconnector.com');
        $this->assertInstanceOf(\Dotdigital\Models\Contact::class, $contact);
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
        $this->assertObjectHasAttribute('id',$contact);
        $this->assertObjectHasAttribute('email',$contact);
        $this->assertObjectHasAttribute('optInType',$contact);
        $this->assertObjectHasAttribute('emailType',$contact);
        $this->assertObjectHasAttribute('dataFields',$contact);
        $this->assertObjectHasAttribute('status',$contact);
    }

    /**
     * @covers \Dotdigital\Resources\Contact::resubscribe
     */
    public function testResubscribeType()
    {
        $contactList = $this->client->contacts->resubscribe('demo@apiconnector.com');
        $this->assertInstanceOf(\Dotdigital\Models\ContactList::class, $contactList);
        foreach ($contactList->contact as $contact) {
            $this->assertInstanceOf(\Dotdigital\Models\Contact::class, $contact);
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
        $this->assertObjectHasAttribute('contact',$contactList);
        foreach ($contactList->contact as $contact) {
            $this->assertObjectHasAttribute('id',$contact);
            $this->assertObjectHasAttribute('email',$contact);
            $this->assertObjectHasAttribute('optInType',$contact);
            $this->assertObjectHasAttribute('emailType',$contact);
            $this->assertObjectHasAttribute('dataFields',$contact);
            $this->assertObjectHasAttribute('status',$contact);
        }

    }

    /**
     * @covers \Dotdigital\Resources\Contact::getByEmail
     */
    public function testGetByEmailType()
    {
        $contact = $this->client->contacts->getByEmail('demo@apiconnector.com');
        $this->assertInstanceOf(\Dotdigital\Models\Contact::class, $contact);

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
        $this->assertObjectHasAttribute('id',$contact);
        $this->assertObjectHasAttribute('email',$contact);
        $this->assertObjectHasAttribute('optInType',$contact);
        $this->assertObjectHasAttribute('emailType',$contact);
        $this->assertObjectHasAttribute('dataFields',$contact);
        $this->assertObjectHasAttribute('status',$contact);
    }

    public function tearDown(): void
    {
        $this->testFailedResponse();
    }

}
