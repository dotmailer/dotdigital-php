<?php

namespace Dotdigital\Tests\V3\Unit;

use Dotdigital\V3\Models\Contact;
use Dotdigital\V3\Models\ContactCollection;
use Dotdigital\V3\Resources\Contacts;

class ContactsTest extends TestCase
{
    /**
     * @var ContactCollection|\PHPUnit\Framework\MockObject\MockObject
     */
    private $contactCollectionMock;

    /**
     * @var Contacts
     */
    private $contactsResource;

    public function setUp(): void
    {
        parent::setUp();

        $this->contactCollectionMock = $this->createMock(ContactCollection::class);
        $this->contactsResource = new Contacts($this->clientMock);
    }

    public function testContactImport()
    {
        $contactCollection = $this->buildContactCollection();

        $this->contactCollectionMock->expects($this->once())
            ->method('all')
            ->willReturn($contactCollection->all());

        $this->clientMock->expects($this->once())
            ->method('mediateResponse')
            ->willReturn('a73a2502-e798-4294-904a-153d9f9b80e9');

        $this->contactsResource->import(
            $this->contactCollectionMock
        );
    }

    /**
     * @return ContactCollection
     * @throws \Exception
     */
    private function buildContactCollection()
    {
        $contacts = [];
        for ($i = 0; $i < 3; $i++) {
            $contacts[] = new Contact([
                'matchIdentifier' => 'email',
                'identifiers' => [
                    'email' => 'chaz' . $i . '@emailsim.io'
                ]
            ]);
        }
        return new ContactCollection($contacts);
    }
}
