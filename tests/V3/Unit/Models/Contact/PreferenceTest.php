<?php

namespace Dotdigital\Tests\V3\Unit\Models\Contact;

use Dotdigital\V3\Models\Contact;
use Dotdigital\V3\Models\Contact\Preference;
use PHPUnit\Framework\TestCase;

class PreferenceTest extends TestCase
{
    /**
     * Verify that Identifiers can have individual properties set.
     */
    public function testIdentifiersCanHaveOwnPropertiesSet()
    {
        $contact = new Contact();
        $preference = new Preference();
        $preference->setId(1);
        $preference->setIsOptedIn(true);
        $contact->setPreferences([$preference]);

        $this->assertEquals(1, $contact->getPreferences()->first()->getId());
    }
}
