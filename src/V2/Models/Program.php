<?php

declare(strict_types=1);

namespace Dotdigital\V2\Models;

/**
 * @property int $id
 * @property string $name
 * @property string $status
 * @property string $dateCreated
 */
class Program extends AbstractSingletonModel
{
    /**
     * @var int
     */
    protected int $id;

    /**
     * @var string
     */
    protected string $name;

    /**
     * @var string
     */
    protected string $status;

    /**
     * @var string
     */
    protected string $dateCreated;
}
