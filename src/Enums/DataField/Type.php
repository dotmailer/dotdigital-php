<?php

namespace Dotdigital\Enums\DataField;

use Dotdigital\Common\Enum;

/**
 * Enum-like representation of Dotdigital data field types.
 *
 * Extends the custom `Enum` base to provide helper methods such as:
 * - `Type::from($value)`
 * - `Type::tryFrom($value)`
 * - `Type::cases()`
 */
class Type extends Enum
{
    /**
     * Text/string field type.
     */
    public const STRING = 'String';

    /**
     * Numeric field type.
     */
    public const NUMERIC = 'Numeric';

    /**
     * Date field type.
     */
    public const DATE = 'Date';

    /**
     * Boolean (true/false) field type.
     */
    public const BOOLEAN = 'Boolean';
}
