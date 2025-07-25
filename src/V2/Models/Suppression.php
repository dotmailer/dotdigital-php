<?php

declare(strict_types=1);

namespace Dotdigital\V2\Models;

class Suppression extends AbstractSingletonModel
{
    /**
     * @var array
     */
    protected array $suppressedContact;

    /**
     * @var string
     */
    protected string $dateRemoved;

    /**
     * @var string
     */
    protected string $reason;
}
