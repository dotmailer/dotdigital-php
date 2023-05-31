<?php

namespace Dotdigital\V3\Models\Contact;

use Dotdigital\V3\Models\AbstractSingletonModel;

class ConsentRecord extends AbstractSingletonModel
{
    /**
     * @var string|null
     */
    protected ?string $text;

    /**
     * @var string|null
     */
    protected ?string $dateTimeConsented;

    /**
     * @var string|null
     */
    protected ?string $url;

    /**
     * @var string|null
     */
    protected ?string $ipAddress;

    /**
     * @var string|null
     */
    protected ?string $userAgent;

    /**
     * @var string|null
     */
    protected ?string $dateTimeCreated;
}
