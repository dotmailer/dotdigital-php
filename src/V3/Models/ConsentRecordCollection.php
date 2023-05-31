<?php

namespace Dotdigital\V3\Models;

use Dotdigital\V3\Models\Collection;
use Dotdigital\V3\Models\Contact\ConsentRecord;

class ConsentRecordCollection extends Collection
{
    protected function getExpectedClass(): ?string
    {
        return ConsentRecord::class;
    }
}
