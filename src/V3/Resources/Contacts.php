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
     * Post contact given email or mobile number or both..
     *
     * @param ContactModel $contact
     * @return ContactModel
     * @throws Exception
     * @throws ResponseValidationException
     */
    public function create(
        ContactModel $contact
    ): ContactModel {
        $response = $this->post(
            self::RESOURCE_BASE,
            json_decode(json_encode($contact), true)
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
