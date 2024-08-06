<?php

namespace Dotdigital\V3\Models\Contact\ChannelProperties;

use Dotdigital\V3\Models\AbstractSingletonModel;

class SmsChannelProperty extends AbstractSingletonModel
{
    /**
     * @var string|null
     */
    protected ?string $optInType;

    /**
     * @var string|null
     */
    protected ?string $status;

    /**
     * @var string|null
     */
    protected ?string $countryCode;

    /**
     * @param $optInType
     *
     * @return self
     */
    public function setOptInType($optInType): SmsChannelProperty
    {
        $this->optInType = $optInType;
        return $this;
    }

    /**
     * @param $status
     *
     * @return self
     */
    public function setStatus($status): SmsChannelProperty
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param $countryCode
     *
     * @return self
     */
    public function setCountryCode($countryCode): SmsChannelProperty
    {
        $this->countryCode = $countryCode;
        return $this;
    }
}
