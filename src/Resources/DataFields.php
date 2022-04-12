<?php

declare(strict_types=1);

namespace Dotdigital\Resources;

use Dotdigital\Models\DataField;
use Dotdigital\Models\DataFieldList;

class DataFields extends AbstractResource
{
    public const RESOURCE_BASE = '/data-fields';

    /**
     * @return DataField[]
     * @throws \Http\Client\Exception
     */
    public function show()
    {
        $list = new DataFieldList($this->get(self::RESOURCE_BASE));
        return $list->toArray();
    }
}
