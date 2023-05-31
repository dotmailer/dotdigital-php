<?php

namespace Dotdigital\V3\Models\Contact\import;

use Dotdigital\V3\Models\Collection;

class FailureCollection extends Collection
{
    /**
     * @return string|null
     */
    protected function getExpectedClass(): ?string
    {
        return Failure::class;
    }
}
