<?php

namespace Dotdigital\V3\Models\Contact\import;

use Dotdigital\V3\Models\Collection;

class FailureDetailCollection extends Collection
{
    /**
     * @return string|null
     */
    protected function getExpectedClass(): ?string
    {
        return FailureDetail::class;
    }
}
