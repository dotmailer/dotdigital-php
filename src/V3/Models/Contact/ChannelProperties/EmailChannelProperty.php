<?php

namespace Dotdigital\V3\Models\Contact\ChannelProperties;

use Dotdigital\V3\Models\AbstractSingletonModel;

class EmailChannelProperty extends AbstractSingletonModel
{
    /**
     * @var string|null
     */
    protected ?string $status;

    /**
     * @var string|null
     */
    protected ?string $emailType;

    /**
     * @var string|null
     */
    protected ?string $optInType;

    /**
     * @param $status
     *
     * @return self
     */
    public function setStatus($status): EmailChannelProperty
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param $emailType
     *
     * @return self
     */
    public function setEmailType($emailType): EmailChannelProperty
    {
        $this->emailType = $emailType;
        return $this;
    }

    /**
     * @param $optInType
     *
     * @return self
     */
    public function setOptInType($optInType): EmailChannelProperty
    {
        $this->optInType = $optInType;
        return $this;
    }
}
