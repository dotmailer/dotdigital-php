<?php

declare(strict_types=1);

namespace Dotdigital\Models;

use Dotdigital\Models\AddressBook;

class AddressBookList extends AbstractListModel implements ListInterface
{
    /**
     * @param array<mixed> $listItem
     *
     * @return AddressBook
     * @throws \Exception
     */
    public function getOne(array $listItem)
    {
        return new AddressBook($listItem);
    }
}
