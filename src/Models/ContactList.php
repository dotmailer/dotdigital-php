<?php

namespace Dotdigital\Models;

use Dotdigital\Models\Contact;

class ContactList extends AbstractListModel implements ListInterface
{
    /**
     * @var string[]
     */
    protected $ignore = [
        'status'
    ];

    /**
     * @param array<mixed> $listItem
     *
     * @return Contact
     * @throws \Exception
     */
    public function getOne(array $listItem)
    {
        return new Contact($listItem);
    }
}
