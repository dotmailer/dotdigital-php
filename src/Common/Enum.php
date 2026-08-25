<?php

namespace Dotdigital\Common;

/**
 * Lightweight enum base class for PHP versions without native enums.
 *
 * Subclasses define enum cases as class constants, for example:
 * `public const ACTIVE = 'active';`
 *
 * This class provides native-like helpers:
 * - `from($value)`   : returns a case instance or throws `\ValueError`
 * - `tryFrom($value)`: returns a case instance or `null`
 * - `cases()`        : returns all case instances
 */
abstract class Enum
{
    /**
     * Enum case name (constant name), e.g. `ACTIVE`.
     */
    public string $name;

    /**
     * Enum backing value, e.g. `'active'` or `1`.
     *
     * @var mixed
     */
    public $value;

    /**
     * Cached enum instances keyed by "<class>_<value>".
     *
     * @var array<string, self>
     */
    private static array $instances = [];

    /**
     * Creates an enum instance for a case.
     *
     * Constructor is protected so instances are only created internally,
     * mirroring native enum behavior.
     *
     * @param string $name  Constant name of the enum case.
     * @param mixed  $value Backing value of the enum case.
     */
    protected function __construct(string $name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Returns the enum case matching the given backing value.
     *
     * @param mixed $value Backing value to resolve.
     *
     * @return self Case instance for the called class.
     *
     * @throws \ValueError|\ReflectionException If no case exists for the provided value.
     */
    public static function from($value): self
    {
        $calledClass = get_called_class();
        $constants = (new \ReflectionClass($calledClass))->getConstants();
        $name = array_search($value, $constants, true);

        if ($name === false) {
            throw new \ValueError(
                "Value '$value' is not a valid backing value for enum $calledClass"
            );
        }

        $cacheKey = $calledClass . '_' . $value;
        if (!isset(self::$instances[$cacheKey])) {
            self::$instances[$cacheKey] = new $calledClass($name, $value);
        }

        return self::$instances[$cacheKey];
    }

    /**
     * Attempts to resolve an enum case by backing value.
     *
     * @param mixed $value Backing value to resolve.
     *
     * @return self|null Matching case instance, or null when not found.
     */
    public static function tryFrom($value): ?self
    {
        try {
            return self::from($value);
        } catch (\ValueError $e) {
            return null;
        }
    }

    /**
     * Returns all enum cases defined by constants on the called class.
     *
     * @return self[] Ordered list of enum case instances.
     */
    public static function cases(): array
    {
        $calledClass = get_called_class();
        $constants = (new \ReflectionClass($calledClass))->getConstants();
        $cases = [];

        foreach ($constants as $value) {
            $cases[] = self::from($value);
        }

        return $cases;
    }
}
