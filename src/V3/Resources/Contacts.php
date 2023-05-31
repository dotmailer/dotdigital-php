<?php

namespace Dotdigital\V3\Resources;

use Dotdigital\Exception\MissingArgumentException;
use Dotdigital\Exception\ResponseValidationException;
use Dotdigital\Resources\AbstractResource;
use Dotdigital\V3\Models\Contact as ContactModel;
use Dotdigital\V3\Models\ContactCollection;
use Http\Client\Exception;

class Contacts extends AbstractResource
{
    public const RESOURCE_BASE = '/contacts/v3';

    public const DEFAULT_IMPORT_MERGE_OPTION = 'overwrite';
    public const DEFAULT_RESUBSCRIBE_NO_CHALLENGE = false;

    /**
     * Post contact given email or mobile number or both.
     *
     * @param array $identifiers
     * @param array $dataFields
     * @param array $channelProperties
     * @param array $lists
     * @param array $preferences
     * @param array $consentRecords
     *
     * @return ContactModel
     * @throws MissingArgumentException
     * @throws ResponseValidationException
     * @throws Exception
     */
    public function create(
        array $identifiers,
        array $dataFields = [],
        array $channelProperties = [],
        array $lists = [],
        array $preferences = [],
        array $consentRecords = []
    ): ContactModel {
        if (!array_key_exists('email', $identifiers) && !array_key_exists('mobileNumber', $identifiers)) {
            throw new MissingArgumentException('Please provide either an email or mobileNumber identifier.');
        }

        $data['identifiers'] = $identifiers;

        if (!empty($channelProperties)) {
            $data['channelProperties'] = $channelProperties;
        }

        if (!empty($dataFields)) {
            $data['dataFields'] = $dataFields;
        }

        if (!empty($consentRecords)) {
            $data['consentRecords'] = $consentRecords;
        }

        if (!empty($lists)) {
            $data['listIds'] = $lists;
        }

        if (!empty($preferences)) {
            $data['preferences'] = $preferences;
        }

        $response = $this->post(
            self::RESOURCE_BASE,
            $data
        );

        return new ContactModel($response);
    }

    /**
     * Get contact by email.
     *
     * @param string $value
     * @param string $identifier
     * @return ContactModel
     * @throws Exception
     */
    public function getByIdentifier(string $value, string $identifier = 'email')
    {
        $url = sprintf('%s/%s/%s', self::RESOURCE_BASE, $identifier, $value);
        return new ContactModel($this->get($url));
    }

    /**
     * @param ContactCollection $contactCollection
     * @param string $mergeOption
     * @param bool $resubscribeWithNoChallenge
     *
     * @return string
     * @throws Exception
     * @throws ResponseValidationException
     */
    public function import(
        ContactCollection $contactCollection,
        string $mergeOption = self::DEFAULT_IMPORT_MERGE_OPTION,
        bool $resubscribeWithNoChallenge = self::DEFAULT_RESUBSCRIBE_NO_CHALLENGE
    ) {
        $data = [
            'mergeOption' => $mergeOption,
            'resubscribeWithNoChallenge' => $resubscribeWithNoChallenge,
            'contacts' => $contactCollection->all()
        ];

        return $this->put(
            sprintf('%s/%s', self::RESOURCE_BASE, 'import'),
            $data
        );
    }
}
