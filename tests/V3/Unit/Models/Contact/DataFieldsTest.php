<?php

namespace Dotdigital\Tests\V3\Unit\Models\Contact;

use Dotdigital\V3\Models\Contact;
use Dotdigital\V3\Models\Contact\DataField;
use Dotdigital\V3\Models\DataFieldCollection;
use PHPUnit\Framework\TestCase;

class DataFieldsTest extends TestCase
{
    public function testDataFieldsCanBeSet()
    {
        $dataFields = [
            'FIRSTNAME' => 'Chaz',
            'LASTNAME' => 'Knox',
        ];
        $contact = new Contact();
        $contact->setDataFields($dataFields);

        $this->assertInstanceOf(DataFieldCollection::class, $contact->getDataFields());
    }

    public function testDataFieldsAreNotSetIfNoneSupplied()
    {
        $dataFields = [];
        $contact = new Contact();
        $contact->setDataFields($dataFields);

        $this->assertEquals(null, $contact->getDataFields());
    }

    public function testSetDataFieldsCanPassEmptyCollection()
    {
        $dataFields = new DataFieldCollection();
        $contact = new Contact();
        $contact->setDataFields($dataFields);

        $this->assertInstanceOf(DataFieldCollection::class, $contact->getDataFields());
    }

    public function testSetDataFieldsCanPassLoadedCollection() {
        $dataField = new DataField('FIRSTNAME', 'Chaz');
        $dataFields = new DataFieldCollection();
        $dataFields->add($dataField);

        $contact = new Contact();
        $contact->setDataFields($dataFields);

        $this->assertInstanceOf(DataFieldCollection::class, $contact->getDataFields());
        $this->assertInstanceOf(DataField::class, $contact->getDataFields()->first());
    }
}
