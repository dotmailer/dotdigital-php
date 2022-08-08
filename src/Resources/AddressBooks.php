<?php

declare(strict_types=1);

namespace Dotdigital\Resources;

use Dotdigital\Models\AddressBook;
use Dotdigital\Models\AddressBookList;

class AddressBooks extends AbstractResource
{
    public const RESOURCE_BASE = '/address-books';

    /**
     * @return AddressBook[]
     * @throws \Http\Client\Exception
     */
    public function show()
    {
        $list = new AddressBookList($this->get(self::RESOURCE_BASE));
        return $list->toArray();
    }

    /**
     * Subscribe contact to a given address book.
     *
     * @param int $addressBookId
     * @param string $email
     * @param string|null $optInType
     * @param string|null $emailType
     * @param array<mixed> $dataFields
     * @return string
     * @throws \Dotdigital\Exception\ResponseValidationException
     * @throws \Http\Client\Exception
     */
    public function addContactToAddressBook(int $addressBookId, string $email, array $dataFields = [], string $optInType = null, string $emailType = null)
    {
        return $this->post(
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
    }

    /**
     * Resubscribe contact to a given address book.
     *
     * @param int $addressBookId
     * @param string $email
     * @param array<mixed> $dataFields
     * @param string|null $preferredLocale
     * @param string|null $returnUrlToUseIfChallenged
     * @return string
     * @throws \Dotdigital\Exception\ResponseValidationException
     * @throws \Http\Client\Exception
     */
    public function resubscribeContactToAddressBook(int $addressBookId, string $email, array $dataFields = [], string $preferredLocale = null, string $returnUrlToUseIfChallenged = null)
    {
        return $this->post(
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
    }
}
