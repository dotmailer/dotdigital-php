<?php

namespace V3\Unit;

use Dotdigital\V3\Models\Contact;
use Dotdigital\V3\Models\Contact\Identifier;
use Dotdigital\V3\Models\Contact\Identifiers;
use Dotdigital\V3\Models\Contact\Import;
use Dotdigital\V3\Models\Contact\Import\Failure;
use Dotdigital\V3\Models\Contact\Import\FailureDetail;
use Dotdigital\V3\Models\Contact\Import\FailureDetailCollection;
use Dotdigital\V3\Models\Contact\Import\Summary;
use Dotdigital\V3\Models\ContactCollection;
use PHPUnit\Framework\TestCase;

/**
 * Class ContactImportTest
 *
 * This class contains unit tests for the Import class.
 * It ensures that the Import class functions correctly and returns the expected results.
 * The tests cover methods such as getImportId(), getStatus(), getSummary(), getCreated(),
 * getUpdated(), and getFailures().
 */
class ContactImportTest extends TestCase
{

    /**
     * Test case for the getStatus() method.
     *
     * It verifies that the status returned by getStatus() matches the expected value.
     */
    public function testGetImportId()
    {
        $import = new Import();
        $import->setImportId('12345');

        $this->assertEquals('12345', $import->getImportId());
    }

    /**
     * Test case for the getStatus() method.
     *
     * It verifies that the status returned by getStatus() matches the expected value.
     */
    public function testGetStatus()
    {
        $import = new Import();
        $import->setStatus('completed');

        $this->assertEquals('completed', $import->getStatus());
    }

    /**
     * Test case for the getCreated() method.
     *
     * It ensures that the ContactCollection returned by getCreated() contains the expected values.
     * The test covers the Contact object, its identifiers, and the values of contactId, email, and mobileNumber.
     */
    public function testGetSummary()
    {
        $summary = [
            'newContacts' => 10,
            'updatedContacts' => 14,
            'globallySuppressed' => 0,
            'invalidEntries' => 2,
            'duplicateIdentifiers' => 2
        ];

        $import = new Import();
        $import->setSummary($summary);

        $summary = $import->getSummary();

        $this->assertInstanceOf(Summary::class, $summary);
        $this->assertEquals(10, $summary->getNewContacts());
        $this->assertEquals(14, $summary->getUpdatedContacts());
        $this->assertEquals(0, $summary->getGloballySuppressed());
        $this->assertEquals(2, $summary->getInvalidEntries());
        $this->assertEquals(2, $summary->getDuplicateIdentifiers());
    }

    /**
     * Test case for the getCreated() method.
     *
     * It ensures that the ContactCollection returned by getCreated() contains the expected values.
     * The test covers the Contact object, its identifiers, and the values of contactId, email, and mobileNumber.
     */
    public function testGetCreated()
    {
        $created = [
            [
                'contactId' => 35212311,
                'identifiers' => [
                    'email' => 'someone@emailsim.io',
                    'mobileNumber' => '447123123123'
                ]
            ]
        ];

        $import = new Import();
        $import->setCreated($created);

        $created = $import->getCreated();

        $this->assertInstanceOf(ContactCollection::class, $created);
        $this->assertInstanceOf(Contact::class, $created->first());
        $this->assertInstanceOf(Identifiers::class, $created->first()->getIdentifiers());
        $this->assertEquals(35212311, $created->first()->getContactId());
        $this->assertEquals('someone@emailsim.io', $created->first()->getIdentifiers()->getEmail());
        $this->assertEquals('447123123123', $created->first()->getIdentifiers()->getMobileNumber());
    }

    /**
     * Test case for the getUpdated() method.
     *
     * It ensures that the ContactCollection returned by getUpdated() contains the expected values.
     * The test covers the Contact object, its identifiers, and the values of contactId, email, and mobileNumber.
     */
    public function testGetUpdated()
    {
        $updated = [
            [
                'contactId' => 35212311,
                'identifiers' => [
                    'email' => 'someone@emailsim.io',
                    'mobileNumber' => '447123123123'
                ]
            ]
        ];

        $import = new Import();
        $import->setUpdated($updated);

        $updated = $import->getUpdated();


        $this->assertCount(1, $updated);
        $this->assertInstanceOf(ContactCollection::class, $updated);
        $this->assertInstanceOf(Contact::class, $updated->first());
        $this->assertInstanceOf(Identifiers::class, $updated->first()->getIdentifiers());
        $this->assertEquals(35212311, $updated->first()->getContactId());
        $this->assertEquals(35212311, $updated->first()->getContactId());
        $this->assertEquals('someone@emailsim.io', $updated->first()->getIdentifiers()->getEmail());
        $this->assertEquals('447123123123', $updated->first()->getIdentifiers()->getMobileNumber());
    }

    /**
     * Test case for the getUpdated() method.
     *
     * It ensures that the ContactCollection returned by getUpdated() contains the expected values.
     * The test covers the Contact object, its identifiers, and the values of contactId, email, and mobileNumber.
     */
    public function testGetFailures()
    {

        $failure = [
            'identifiers' => [
                'email' => 'bob@emailsim@io.com'
            ],
            'failures' => [
                [
                    'failureCode' => 'invalidEmail',
                    'description' => "Invalid value for 'email'"
                ]
            ]
        ];

        $import = new Import();
        $import->setFailures([$failure]);

        $failures = $import->getFailures();

        $this->assertInstanceOf(Failure::class, $failures->first());
        $this->assertInstanceOf(Identifier::class, $failures->first()->getIdentifiers());
        $this->assertInstanceOf(FailureDetailCollection::class, $failures->first()->getFailures());
        $this->assertInstanceOf(FailureDetail::class, $failures->first()->getFailures()->first());
        $this->assertEquals('bob@emailsim@io.com', $failures->first()->getIdentifiers()->getEmail());
        $this->assertEquals('invalidEmail', $failures
            ->first()
            ->getFailures()
            ->first()
            ->getFailureCode()
        );
        $this->assertEquals("Invalid value for 'email'", $failures
            ->first()
            ->getFailures()
            ->first()
            ->getDescription()
        );
    }
}
