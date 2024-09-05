<?php

namespace Dotdigital\V3\Models\Import\Failure;

use Dotdigital\V3\Models\Collection;
use Dotdigital\V3\Models\Contact\Import\Failure;
use Dotdigital\V3\Models\Import\FailureCollectionInterface;
use Dotdigital\V3\Models\Import\FailureInterface;

class FailureCollection extends Collection implements FailureCollectionInterface
{
    /**
     * @return string|null
     */
    protected function getExpectedClass(): ?string
    {
        return FailureInterface::class;
    }
}
