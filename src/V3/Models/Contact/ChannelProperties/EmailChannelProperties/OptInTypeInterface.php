<?php

declare(strict_types=1);

namespace Dotdigital\V3\Models\Contact\ChannelProperties\EmailChannelProperties;

interface OptInTypeInterface
{
    public const UNKNOWN = 'unknown';
    public const SINGLE = 'single';
    public const DOUBLE = 'double';
    public const VERIFIED_DOUBLE = 'verifiedDouble';
}
