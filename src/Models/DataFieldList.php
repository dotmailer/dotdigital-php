<?php

declare(strict_types=1);

namespace Dotdigital\Models;

use Dotdigital\Models\DataField;

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
