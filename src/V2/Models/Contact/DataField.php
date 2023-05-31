<?php

namespace Dotdigital\V2\Models\Contact;

use Dotdigital\V2\Models\AbstractSingletonModel;

class DataField extends AbstractSingletonModel
{
    /**
     * @var string
     */
    protected string $key;

    /**
     * @var string
     */
    protected string $value;
}
