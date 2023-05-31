<?php

namespace Dotdigital\V3\Models\Contact;

use Dotdigital\V3\Models\AbstractSingletonModel;

class Identifier extends AbstractSingletonModel
{
    /**
     * @var string
     */
    protected string $email;

    /**
     * @var string
     */
    protected string $mobileNumber;

    /**
     * @param string $email
     * @return void
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param string $mobileNumber
     * @return void
     */
    public function setMobileNumber(string $mobileNumber): void
    {
        $this->mobileNumber = $mobileNumber;
    }
}
