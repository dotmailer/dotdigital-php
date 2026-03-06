<?php

namespace Dotdigital\V2\Resources;

use Dotdigital\Resources\AbstractResource;
use Dotdigital\V2\Models\SegmentList;

class Segments extends AbstractResource
{
    public const RESOURCE_BASE = '/segments';

    /**
     * Get all segments.
     *
     * @return SegmentList
     * @throws \Http\Client\Exception
     * @throws \Exception
     */
    public function all()
    {
        return new SegmentList($this->get(self::RESOURCE_BASE));
    }
}
