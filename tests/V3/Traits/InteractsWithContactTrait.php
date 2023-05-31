<?php

namespace Dotdigital\Tests\V3\Traits;

use Dotdigital\V3\Models\Contact;
use Dotdigital\V3\Models\ContactCollection;
use Faker\Factory as FakerFactory;

trait InteractsWithContactTrait
{
    public const MOCK_LISTS = [];

    public const MOCK_PREFERENCES = [];

    protected function buildContactCollection()
    {
        $contact1 = new Contact(
            [
                ...(!empty(static::MOCK_LISTS)) ?  ['lists' => static::MOCK_LISTS] : [],
                'matchIdentifier' => 'email',
                'identifiers' => [
                    'email' => 'chaz0959@emailsim.io'
                ],
                'dataFields' => [
                    'FIRST_NAME' => 'Chaz',
                    'LAST_NAME' => 'Kangaroo',
                    'COMPANY' => 'Chaz Inc.'
                ],
                'consentRecords' => [
                    [
                        "text" => "Yes, I would like to receive a monthly newsletter",
                        "dateTimeConsented" => "2018-01-26T21:29:00",
                        "url" => "http://www.example.com/signup",
                        "ipAddress" => "129.168.0.2",
                        "userAgent" => "Mozilla/5.0 (X11; OpenBSD i386) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36"
                    ]
                ]
            ]
        );
        $contact2 = new Contact(
            [
                ...(!empty(static::MOCK_LISTS)) ?  ['lists' => static::MOCK_LISTS] : [],
                ...(!empty(static::MOCK_PREFERENCES)) ?  ['preferences' => static::MOCK_PREFERENCES] : [],
                'matchIdentifier' => 'mobileNumber',
                'identifiers' => [
                    'email' => 'chaz1702@emailsim.io',
                    'mobileNumber' => '44123123123'
                ],
                'dataFields' => [
                    'firstName' => 'Chaznay',
                    'lastName' => 'Kangaroo',
                    'gender' => 'female'
                ],
                'channelProperties' => [
                    'email' => [
                        'emailType' => 'Html',
                        'optInType' => 'Single'
                    ],
                    'sms' => [
                        'optInType' => 'Single'
                    ]
                ]
            ]
        );
        $contact3 = new Contact(
            [
                'matchIdentifier' => 'email',
                'identifiers' => [
                    'email' => 'chaz1703@emailsim.io'
                ],
                'dataFields' => [
                    'firstName' => 'Chazzandra',
                    'lastName' => 'Kangaroo',
                    'gender' => 'female'
                ]
            ]
        );
        return new ContactCollection([
            $contact1,
            $contact2,
            $contact3
        ]);
    }

    protected function buildContactCollectionWithoutMatchIdentifier()
    {
        $contact1 = new Contact(
            [
                'identifiers' => [
                    'email' => 'chaz1@emailsim.io'
                ],
            ]
        );

        return new ContactCollection([$contact1]);
    }

    protected function buildContactCollectionWithoutIdentifiers()
    {
        $contact1 = new Contact(
            [
                'matchIdentifier' => 'email',
            ]
        );

        return new ContactCollection([$contact1]);
    }

    /**
     * @param int $count
     * @return ContactCollection
     * @throws \Exception
     */
    public static function generateContactCollection(int $count): ContactCollection
    {
        $faker = FakerFactory::create();
        $collection = new ContactCollection();
        for ($i = 0; $i < $count; $i++) {
            $collection->add(
                new Contact([
                    "matchIdentifier" => "email",
                    "identifiers" => [
                        "email" => $faker->safeEmail,
                    ],
                    "dataFields" => [
                        "firstName" => $faker->firstName,
                        "lastName" => $faker->lastName,
                        "gender" => $faker->word
                    ]
                ])
            );
        }

        $collection->add(
            new Contact([
                "matchIdentifier" => "email",
                "identifiers" => [
                    "email" => $faker->word,
                ],
                "dataFields" => [
                    "firstName" => $faker->firstName,
                    "lastName" => $faker->lastName,
                    "gender" => $faker->word
                ]
            ])
        );

        return $collection;

    }
}
