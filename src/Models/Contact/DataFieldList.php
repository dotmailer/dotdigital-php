<?php

namespace Dotdigital\Models\Contact;

use Dotdigital\Models\AbstractListModel;
use Dotdigital\Models\ListInterface;

class DataFieldList extends AbstractListModel implements ListInterface
{
    /**
     * @param array<mixed> $listItem
     *
     * @return DataField
     * @throws \Exception
     */
    public function getOne(array $listItem)
    {
        return new DataField($listItem);
    }
}
