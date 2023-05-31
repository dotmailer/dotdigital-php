<?php

declare(strict_types=1);

namespace Dotdigital\V2\Resources;

use Dotdigital\Resources\AbstractResource;
use Dotdigital\V2\Models\AddressBookList;
use Dotdigital\V2\Models\Contact;
use Dotdigital\V2\Models\ContactList;

class AddressBooks extends AbstractResource
{
    public const RESOURCE_BASE = '/address-books';

    /**
     * Get list of address books.
     *
     * @return AddressBookList
     * @throws \Http\Client\Exception
     */
    public function show()
    {
        return new AddressBookList($this->get(self::RESOURCE_BASE));
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
     * @throws \Http\Client\Exception
     */
    public function addContactToAddressBook(int $addressBookId, string $email, array $dataFields = [], string $optInType = null, string $emailType = null)
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
     * @throws \Http\Client\Exception
     */
    public function resubscribeContactToAddressBook(int $addressBookId, string $email, array $dataFields = [], string $preferredLocale = null, string $returnUrlToUseIfChallenged = null)
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
}
