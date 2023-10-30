<?php

namespace Dotdigital\V3\Models\InsightData;

use Dotdigital\V3\Models\AbstractSingletonModel;
use Dotdigital\V3\Models\InsightData\ContactIdentity;

class Record extends AbstractSingletonModel
{
    /**
     * @var ContactIdentity|null
     */
    protected ?ContactIdentity $contactIdentity;

    /**
     * @var string
     */
    protected string $key;

    /**
     * @var array
     */
    protected array $json;

    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function setContactIdentity(array $data)
    {
        $this->contactIdentity = new ContactIdentity($data);
    }
}
