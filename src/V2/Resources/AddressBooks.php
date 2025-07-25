<?php

declare(strict_types=1);

namespace Dotdigital\V2\Resources;

use Dotdigital\Resources\AbstractResource;
use Dotdigital\V2\Models\AddressBookList;
use Dotdigital\V2\Models\Contact;
use Dotdigital\V2\Models\ContactList;
use Dotdigital\V2\Models\Suppression;
use Http\Client\Exception;

class AddressBooks extends AbstractResource
{
    public const RESOURCE_BASE = '/address-books';
    public const SELECT_LIMIT = 50;

    /**
     * Get list of address books.
     *
     * @param int $skip
     * @param int $select
     * @return AddressBookList
     * @throws Exception
     */
    public function show(int $skip = 0, int $select = self::SELECT_LIMIT)
    {
        $uriParams = sprintf(
            '?select=%s&skip=%s',
            $select,
            $skip
        );
        return new AddressBookList($this->get(self::RESOURCE_BASE . $uriParams));
    }

    /**
     * Subscribe contact to a given address book.
     *
     * @param int $addressBookId
     * @param string $email
     * @param string|null $optInType
     * @param string|null $emailType
     * @param array<mixed> $dataFields
     * @return Contact
     * @throws \Dotdigital\Exception\ResponseValidationException
     * @throws Exception
     */
    public function addContactToAddressBook(int $addressBookId, string $email, array $dataFields = [], ?string $optInType = null, ?string $emailType = null)
    {
        $response = $this->post(
            sprintf(
                self::RESOURCE_BASE . '/%s' . '/contacts',
                $addressBookId
            ),
            [
                "email" => $email,
                "optInType" => $optInType,
                "emailType" => $emailType,
                "dataFields" => $this->resolveDataFields($dataFields)
            ]
        );
        return new Contact($response);
    }

    /**
     * Resubscribe contact to a given address book.
     *
     * @param int $addressBookId
     * @param string $email
     * @param array<mixed> $dataFields
     * @param string|null $preferredLocale
     * @param string|null $returnUrlToUseIfChallenged
     * @return ContactList
     * @throws \Dotdigital\Exception\ResponseValidationException
     * @throws Exception
     */
    public function resubscribeContactToAddressBook(int $addressBookId, string $email, array $dataFields = [], ?string $preferredLocale = null, ?string $returnUrlToUseIfChallenged = null)
    {
        $response = $this->post(
            sprintf(
                self::RESOURCE_BASE . '/%s/' . 'contacts/resubscribe',
                $addressBookId
            ),
            [
                "unsubscribedContact" => [
                    "email" => $email,
                    "dataFields" => $this->resolveDataFields($dataFields)
                ],
                "preferredLocale" => $preferredLocale,
                "returnUrlToUseIfChallenged" => $returnUrlToUseIfChallenged
            ]
        );

        return new ContactList($response);
    }

    /**
     * Unsubscribe contact from a given address book.
     *
     * @param int $addressBookId
     * @param string $email
     * @return Suppression
     * @throws \Exception|Exception
     */
    public function unsubscribeContactFromAddressBook(int $addressBookId, string $email)
    {
        $response = $this->post(
            sprintf(
                self::RESOURCE_BASE . '/%s/' . 'contacts/unsubscribe',
                $addressBookId
            ),
            [
                "email" => $email
            ]
        );

        return new Suppression($response);
    }
}
