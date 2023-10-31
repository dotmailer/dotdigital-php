<?php

namespace Dotdigital\Tests\V3\Integration\InsightData;

use Dotdigital\AbstractClient;
use Dotdigital\Exception\ResponseValidationException;
use Dotdigital\V3\Models\Contact;
use Dotdigital\V3\Models\ContactCollection;
use Dotdigital\V3\Resources\InsightData;
use Dotdigital\Tests\V3\Integration\TestCase;
use Dotdigital\Tests\V3\Traits\InteractsWithContactTrait;

/**
 * @runTestsInSeparateProcesses
 * @coversDefaultClass InsightData
 */
class InsightDataCreateUpdateAccountCollectionTest extends TestCase
{
    use InteractsWithContactTrait;

    protected string $resourceBase = InsightData::RESOURCE_BASE;

    protected AbstractClient $client;

    /**
     * @return void
     */
    public function testIntegrationInsightDataUpsert()
    {
        $response = $this->client->insightData->createOrUpdateAccountCollectionRecord(
            'Integrations',
            'php-app.dev',
            [
                'recordId' => 'php-app.dev',
                'platform' => 'SDK Test',
                'configuration' => [
                    [
                        'carBrand' => 'Skoda',
                        'carModel' => 'Octavia'
                    ]
                ]
            ]
        );

        $this->assertIsString($response);
    }
}
