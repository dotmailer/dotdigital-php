<?php

namespace Dotdigital\V3\Models\InsightData;

use Dotdigital\V3\Models\AbstractSingletonModel;

class ContactIdentity extends AbstractSingletonModel
{
    /**
     * @var string
     */
    protected string $identifier;

    /**
     * @var string
     */
    protected string $value;
}
