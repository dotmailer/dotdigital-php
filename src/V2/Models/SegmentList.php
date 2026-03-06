<?php

namespace Dotdigital\V2\Models;

use Dotdigital\Models\ListInterface;

class SegmentList extends AbstractListModel implements ListInterface
{
    /**
     * @param array<mixed> $listItem
     *
     * @return Segment
     * @throws \Exception
     */
    public function getOne(array $listItem)
    {
        return new Segment($listItem);
    }
}
