<?php

namespace Dotdigital\Tests\V2\Integration\Resources;

use Dotdigital\Tests\ApiConfigurationTrait;
use Dotdigital\V2\Client;
use Dotdigital\V2\Resources\AccountInfo;
use PHPUnit\Framework\TestCase;

class AddressBooksTest extends TestCase
{
    use ApiConfigurationTrait;

    protected string $resourceBase = AccountInfo::RESOURCE_BASE;


    public function setUp(): void
    {
        $this->client = new Client();
        $this->clientInit();
    }

    public function testAddressBooksContent()
    {
        $addressBooks = $this->client->addressBooks->show();
        foreach ($addressBooks->getList() as $addressBook) {
            $this->assertTrue(property_exists($addressBook, 'id'));
            $this->assertTrue(property_exists($addressBook, 'name'));
            $this->assertTrue(property_exists($addressBook, 'visibility'));
            $this->assertTrue(property_exists($addressBook, 'contacts'));
        }
    }

    public function testUnsubscribeContactFromAddressBook()
    {
        // Get second address book in list as the first will all ways be "TEST"
        $addressBooks = $this->client->addressBooks->show();
        $addressBook = $addressBooks->getList()[1];
        $testEmail = 'test.contact.' . uniqid() . '@example.com';
        $contact = $this->client->addressBooks->addContactToAddressBook(
            $addressBook->getId(),
            $testEmail
        );

        $this->assertEquals($testEmail, $contact->getEmail());

        $suppressedContact = $this->client->addressBooks->unsubscribeContactFromAddressBook(
            $addressBook->getId(),
            $testEmail
        );

        // Verify suppressed contact properties
        $this->assertTrue(property_exists($suppressedContact, 'suppressedContact'));
        $this->assertTrue(property_exists($suppressedContact, 'dateRemoved'));
        $this->assertTrue(property_exists($suppressedContact, 'reason'));
    }
}
