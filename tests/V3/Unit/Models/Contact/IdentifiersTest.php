<?php

namespace Dotdigital\Tests\V3\Unit\Models\Contact;

use Dotdigital\V3\Models\Contact;
use Dotdigital\V3\Models\Contact\Identifiers;
use PHPUnit\Framework\TestCase;

class IdentifiersTest extends TestCase
{
    /**
     * Verify that Identifiers can have individual properties set.
     */
    public function testIdentifiersCanHaveOwnPropertiesSet()
    {
        $contact = new Contact();
        $identifiers = new Identifiers();
        $identifiers->setEmail('chaz@emailsim.io');
        $identifiers->setMobileNumber('1234567890');
        $contact->setIdentifiers($identifiers);

        $this->assertEquals('chaz@emailsim.io', $contact->getIdentifiers()->getEmail());
    }
}
