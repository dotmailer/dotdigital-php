<?php

namespace Dotdigital\V2\Models\Contact;

use Dotdigital\Models\ListInterface;
use Dotdigital\V2\Models\AbstractListModel;

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
