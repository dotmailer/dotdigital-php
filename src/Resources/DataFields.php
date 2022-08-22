<?php

declare(strict_types=1);

namespace Dotdigital\Resources;

use Dotdigital\Models\DataField;
use Dotdigital\Models\DataFieldList;

class DataFields extends AbstractResource
{
    public const RESOURCE_BASE = '/data-fields';

    /**
     * @return DataFieldList
     * @throws \Http\Client\Exception
     * @throws \Exception
     */
    public function show()
    {
        return new DataFieldList($this->get(self::RESOURCE_BASE));
    }
}
