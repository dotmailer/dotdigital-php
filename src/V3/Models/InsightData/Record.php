<?php

namespace Dotdigital\V3\Models\InsightData;

use Dotdigital\V3\Models\AbstractSingletonModel;
use Dotdigital\V3\Models\InsightData\InsightDataIdentity;

class Record extends AbstractSingletonModel
{
    /**
     * @var InsightDataIdentity|null
     */
    protected ?InsightDataIdentity $contactIdentity;

    /**
     * @var string
     */
    protected string $key;

    /**
     * @var array
     */
    protected array $json;

    /**
     * @param array|InsightDataIdentity $data
     * @return void
     * @throws \Exception
     */
    public function setContactIdentity($data)
    {
        $this->contactIdentity = new InsightDataIdentity($data);
    }
}
