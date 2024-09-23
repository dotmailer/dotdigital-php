<?php

namespace Dotdigital\Tests\V3\Unit\Models\Contact;

use Dotdigital\V3\Models\Contact;
use Dotdigital\V3\Models\Contact\ChannelProperties\EmailChannelProperty;
use PHPUnit\Framework\TestCase;

class ChannelPropertyTest extends TestCase
{
    /**
     * Verify that channel properties can be set from an array.
     */
    public function testChannelPropertiesCanBeSetFromArray()
    {
        $contact = new Contact(
            [
                'channelProperties' => [
                    'email' => [
                        'status' => 'subscribed',
                        'emailType' => 'html',
                        'optInType' => 'unknown'
                    ]
                ]
            ]
        );

        $this->assertEquals('subscribed', $contact->getChannelProperties()->getEmail()->getStatus());
    }

    /**
     * Verify that channel properties can be set from a hydrated ChannelProperty object.
    */
    public function testChannelPropertiesCanBeSetWithAHydratedObject()
    {
        $contact = new Contact();
        $channelProperty = new EmailChannelProperty(
            [
                'status' => 'subscribed',
                'emailType' => 'html',
                'optInType' => 'unknown'
            ]
        );
        $contact->setChannelProperties([
            'email' => $channelProperty
        ]);

        $this->assertEquals('subscribed', $contact->getChannelProperties()->getEmail()->getStatus());
    }
}
