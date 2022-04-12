<?php

declare(strict_types=1);

namespace Dotdigital\Models;

/**
 * @property int $id
 * @property string $name
 * @property string $visibility
 * @property int $contacts
 */
class AddressBook extends AbstractSingletonModel
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
    protected string $visibility;

    /**
     * @var int
     */
    protected int $contacts;
}
