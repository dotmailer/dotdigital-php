<?php

namespace Dotdigital\V3\Models;

use Dotdigital\V3\Models\Collection;

class ContactCollection extends Collection
{
    protected function getExpectedClass(): ?string
    {
        return Contact::class;
    }
}
