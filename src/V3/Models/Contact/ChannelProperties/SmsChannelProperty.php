<?php

namespace Dotdigital\V3\Models\Contact\ChannelProperties;

use Dotdigital\V3\Models\AbstractSingletonModel;

class SmsChannelProperty extends AbstractSingletonModel
{
    /**
     * @var string|null
     */
    protected ?string $optInType;
}
