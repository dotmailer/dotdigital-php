<?php

namespace Dotdigital\V3\Models\Contact;

use Dotdigital\V3\Models\AbstractSingletonModel;

class Preference extends AbstractSingletonModel
{
    /**
     * @var string|null
     */
    protected ?string $publicName;

    /**
     * @var string|null
     */
    protected ?string $privateName;

    /**
     * @var int|null
     */
    protected ?int $id;

    /**
     * @var bool|null
     */
    protected ?bool $isOptedIn;
}
