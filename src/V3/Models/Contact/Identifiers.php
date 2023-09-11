<?php

namespace Dotdigital\V3\Models\Contact;

use Dotdigital\V3\Models\AbstractSingletonModel;

/**
 * @method getEmail()
 * @method getMobileNumber()
 */
class Identifiers extends AbstractSingletonModel
{
    /**
     * @var int
     */
    protected int $contactId;

    /**
     * @var string
     */
    protected string $email;

    /**
     * @var string
     */
    protected string $mobileNumber;
}
