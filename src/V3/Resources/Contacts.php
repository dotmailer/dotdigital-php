<?php

namespace Dotdigital\V3\Resources;

use Dotdigital\Exception\ResponseValidationException;
use Dotdigital\Resources\AbstractResource;
use Dotdigital\V3\Models\Contact as ContactModel;
use Dotdigital\V3\Models\Contact\Import;
use Dotdigital\V3\Models\ContactCollection;
use Dotdigital\V3\Utility\Pagination\PageableResourceInterface;
use Dotdigital\V3\Utility\Pagination\ParameterCollection;
use Http\Client\Exception;

class Contacts extends AbstractResource implements PageableResourceInterface
{
    public const RESOURCE_BASE = '/contacts/v3';
    public const DEFAULT_IMPORT_MERGE_OPTION = 'overwrite';

    /**
     * Post contact given email or mobile number or both.
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
     * Retrieves the status of a contacts import request and the results if available.
     *
     * @param string $importId
     * @return \Dotdigital\V3\Models\Contact\Import
     * @throws Exception
     * @throws \Exception
     */
    public function getImportById(string $importId): Import
    {
        $response = $this->get(
            sprintf(
                '%s/%s/%s',
                self::RESOURCE_BASE,
                'import',
                $importId,
            )
        );
        return new Import($response);
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
     *
     * @return string
     * @throws Exception
     * @throws ResponseValidationException
     */
    public function import(
        ContactCollection $contactCollection,
        string $mergeOption = self::DEFAULT_IMPORT_MERGE_OPTION
    ) {
        $data = [
            'mergeOption' => $mergeOption,
            'contacts' => $contactCollection->all()
        ];

        return $this->put(
            sprintf('%s/%s', self::RESOURCE_BASE, 'import'),
            $data
        );
    }

    /**
     * @param ParameterCollection $parameterCollection
     * @return string
     * @throws Exception
     */
    public function getContacts(ParameterCollection $parameterCollection): string
    {
        $response = $this->get(
            sprintf(
                '%s/%s',
                self::RESOURCE_BASE,
                '?' . $parameterCollection->toQueryString()
            )
        );

        return $response;
    }

    /**
     * @inheritDoc PageableResourceInterface
     */
    public function getPaged(ParameterCollection $parameterCollection): string
    {
        $response = $this->get(
            sprintf(
                '%s/%s',
                self::RESOURCE_BASE,
                '?' . $parameterCollection->toQueryString()
            )
        );

        return $response;
    }
}
