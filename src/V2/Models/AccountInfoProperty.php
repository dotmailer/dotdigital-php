<?php

declare(strict_types=1);

namespace Dotdigital\V2\Models;

/**
 * @property string $name
 * @property string $type
 * @property string $value
 */
class AccountInfoProperty extends AbstractSingletonModel
{
    /**
     * @var string
     */
    protected string $name;

    /**
     * @var string
     */
    protected string $type;

    /**
     * @var string
     */
    protected string $value;
}
