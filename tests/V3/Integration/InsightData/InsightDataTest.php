<?php

namespace Dotdigital\Tests\V3\Integration\InsightData;

use Dotdigital\AbstractClient;
use Dotdigital\Tests\V3\Integration\TestCase;
use Dotdigital\Tests\V3\Traits\InteractsWithContactTrait;
use Dotdigital\V3\Resources\InsightData;

class InsightDataTest extends TestCase
{
    use InteractsWithContactTrait;

    protected string $resourceBase = InsightData::RESOURCE_BASE . '/import/paokre';

    protected AbstractClient $client;

    public function testSuccessInsightDataImport()
    {
        $contact = $this->buildContact();
        $email = $contact->getIdentifiers()->getEmail();
        $insightCollection = $this->createInsightRecords($email);
        $this->client->contacts->create($contact);
        $importId = $this->client->insightData->import($insightCollection);

        $import = json_decode($importId);
        $this->assertObjectHasProperty('importId', $import);
    }

    /**
     * @param $email
     * @return \Dotdigital\V3\Models\InsightData
     * @throws \Exception
     */
    private function createInsightRecords($email)
    {
        return new \Dotdigital\V3\Models\InsightData([
            "collectionName" => "ConsentInsight",
            "collectionScope" => "contact",
            "collectionType" => "ConsentInsight",
            "records" => [
                [
                    'contactIdentity' => [
                        'identifier' => 'email',
                        'value' => $email
                    ],
                    "key" => "1001",
                    "json" => [
                        "text" => "Yes, I would like to receive a monthly newsletter",
                        "dateTimeConsented" =>  "2023-01-26T21:29:00",
                        "url" => "http://www.example.com/signup",
                        "ipAddress" => "129.168.0.2",
                        "userAgent" => "Mozilla/5.0 (X11; OpenBSD i386) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36"
                    ]
                ],
                [
                    'contactIdentity' => [
                        'identifier' => 'email',
                        'value' => $email
                    ],
                    "key" => "1003",
                    "json" => [
                        "text" => "Yes, I would like to receive a monthly newsletter",
                        "dateTimeConsented" =>  "2023-01-26T21:29:00",
                        "url" => "http://www.example.com/signup",
                        "ipAddress" => "129.168.0.2",
                        "userAgent" => "Mozilla/5.0 (X11; OpenBSD i386) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36"
                    ]
                ],
                [
                    'contactIdentity' => [
                        'identifier' => 'email',
                        'value' => $email
                    ],
                    "key" => "1005",
                    "json" => [
                        "text" => "Yes, I would like to receive a monthly newsletter",
                        "dateTimeConsented" =>  "2023-01-26T21:29:00",
                        "url" => "http://www.example.com/signup",
                        "ipAddress" => "129.168.0.2",
                        "userAgent" => "Mozilla/5.0 (X11; OpenBSD i386) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36"
                    ]
                ]
            ]
        ]);
    }
}
