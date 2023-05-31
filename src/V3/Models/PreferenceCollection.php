<?php

namespace Dotdigital\V3\Models;

use Dotdigital\V3\Models\Collection;
use Dotdigital\V3\Models\Contact\Preference;

class PreferenceCollection extends Collection
{
    protected function getExpectedClass(): ?string
    {
        return Preference::class;
    }
}
