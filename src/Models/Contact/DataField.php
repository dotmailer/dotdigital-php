<?php

namespace Dotdigital\Models\Contact;

use Dotdigital\Models\AbstractSingletonModel;

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
