<?php

namespace Dotdigital\Tests\V3\Unit\Models\InsightData;

use Dotdigital\V3\Models\InsightData;
use Dotdigital\V3\Models\InsightData\ContactIdentity;
use PHPUnit\Framework\TestCase;

class RecordTest extends TestCase
{
    /**
     * Verify that channel properties can be set from an array.
     */
    public function testRecordContactIdentityCanBeSetFromArray()
    {
        $data = new InsightData(
            [
                'records' => [
                    [
                        'contactIdentity' => [
                            'identifier' => 'email',
                            'value' => 'chaz@emailsim.io'
                        ]
                    ]
                ]
            ]
        );

        $this->assertEquals(
            'chaz@emailsim.io',
            $data->getRecords()->first()->getContactIdentity()->getValue()
        );
    }

    /**
     * Verify that channel properties can be set from a hydrated ChannelProperty object.
     */
    public function testRecordContactIdentityCanBeSetWithAHydratedObject()
    {
        $data = new InsightData();
        $contactIdentity = new ContactIdentity([
            'identifier' => 'email',
            'value' => 'chaz@emailsim.io'
        ]);
        $data->setRecords([
            [
                'contactIdentity' => $contactIdentity
            ]
        ]);

        $this->assertEquals(
            'chaz@emailsim.io',
            $data->getRecords()->first()->getContactIdentity()->getValue()
        );
    }
}
