<?php

namespace Dotdigital\V3\Models\Contact\ChannelProperties;

use Dotdigital\V3\Models\AbstractSingletonModel;

class EmailChannelProperty extends AbstractSingletonModel
{
    /**
     * @var string|null
     */
    protected ?string $status;

    /**
     * @var string|null
     */
    protected ?string $emailType;

    /**
     * @var string|null
     */
    protected ?string $optInType;
}
