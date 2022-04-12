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
}
