<?php

namespace Dotdigital\V3\Models\Contact;

use Dotdigital\V3\Models\AbstractSingletonModel;
use Dotdigital\V3\Models\Contact\ChannelProperties\EmailChannelProperty;
use Dotdigital\V3\Models\Contact\ChannelProperties\SmsChannelProperty;

class ChannelProperty extends AbstractSingletonModel
{
    /**
     * @var EmailChannelProperty|null
     */
    protected ?EmailChannelProperty $email;

    /**
     * @var SmsChannelProperty|null
     */
    protected ?SmsChannelProperty $sms;

    /**
     * @param array|EmailChannelProperty $property
     *
     * @return void
     * @throws \Exception
     */
    public function setEmail($property)
    {
        $this->email = new EmailChannelProperty($property);
    }

    /**
     * @param array|SmsChannelProperty $property
     *
     * @return void
     * @throws \Exception
     */
    public function setSms($property)
    {
        $this->sms = new SmsChannelProperty($property);
    }
}
