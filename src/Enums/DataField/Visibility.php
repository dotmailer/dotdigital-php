<?php

namespace Dotdigital\Enums\DataField;

use Dotdigital\Common\Enum;

/**
 * Enum-like representation of data field visibility options in Dotdigital.
 *
 * Extends the custom `Enum` base to provide helper methods such as:
 * - `Visibility::from($value)`
 * - `Visibility::tryFrom($value)`
 * - `Visibility::cases()`
 */
class Visibility extends Enum
{
    /**
     * Private visibility (restricted/non-public field).
     */
    public const PRIVATE = 'Private';

    /**
     * Public visibility (exposed/publicly available field).
     */
    public const PUBLIC = 'Public';
}
