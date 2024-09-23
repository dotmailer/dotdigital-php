<?php

namespace Dotdigital\V3\Models\Contact\Import\Failure;

use Dotdigital\V3\Models\Collection;
use Dotdigital\V3\Models\Import\FailureCollectionInterface;

class FailureDetailCollection extends Collection implements FailureCollectionInterface
{
    /**
     * @return string|null
     */
    protected function getExpectedClass(): ?string
    {
        return FailureDetail::class;
    }
}
