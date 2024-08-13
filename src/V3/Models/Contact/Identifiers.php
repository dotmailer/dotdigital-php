<?php

namespace Dotdigital\V3\Models\Contact;

use Dotdigital\V3\Models\AbstractSingletonModel;

/**
 * @method getContactId()
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

    /**
     * @param int $contactId
     *
     * @return self
     */
    public function setContactId(int $contactId): Identifiers
    {
        $this->contactId = $contactId;
        return $this;
    }

    /**
     * @param string $email
     *
     * @return self
     */
    public function setEmail(string $email): Identifiers
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string $mobileNumber
     *
     * @return self
     */
    public function setMobileNumber(string $mobileNumber): Identifiers
    {
        $this->mobileNumber = $mobileNumber;
        return $this;
    }
}
