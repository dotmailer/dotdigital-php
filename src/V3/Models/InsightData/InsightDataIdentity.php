<?php

namespace Dotdigital\V3\Models\InsightData;

use Dotdigital\V3\Models\AbstractSingletonModel;

class InsightDataIdentity extends AbstractSingletonModel
{
    /**
     * @var string
     */
    protected $identifier;

    /**
     * @var string
     */
    protected $value;
}
