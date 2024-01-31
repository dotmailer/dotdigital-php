<?php

namespace Dotdigital\Tests\V3\Integration\InsightData;

use Dotdigital\AbstractClient;
use Dotdigital\Exception\ResponseValidationException;
use Dotdigital\V3\Models\Contact;
use Dotdigital\V3\Models\ContactCollection;
use Dotdigital\V3\Resources\InsightData;
use Dotdigital\Tests\V3\Integration\TestCase;
use Dotdigital\Tests\V3\Traits\InteractsWithContactTrait;
use Random\RandomException;

/**
 * @runTestsInSeparateProcesses
 * @coversDefaultClass InsightData
 */
class InsightDataContactCollectionTest extends TestCase
{
    use InteractsWithContactTrait;

    protected string $resourceBase = InsightData::RESOURCE_BASE;

    protected AbstractClient $client;

    /**
     * @return void
     * @throws RandomException
     */
    public function testCartInsightDataUpsert()
    {
        $email = bin2hex(random_bytes(16)) . '@emailsim.io';
        $contact = new Contact(
        [
            'matchIdentifier' => 'email',
            'identifiers' => [
                'email' => $email
            ]
        ]);

        $this->client->contacts->create($contact);

        $response = $this->client->insightData->createOrUpdateContactCollectionRecord(
            'CartInsight',
            '1',
            'email',
            $email,
            [
                'key' => '1001',
	            'contactIdentifier' => $email,
	            'json' => [
                    'cartId' => '1',
                    'grandTotal' => '90.00',
                    'lineItems' => []
                ]
            ]
        );

        $this->assertIsString($response);
    }
}
