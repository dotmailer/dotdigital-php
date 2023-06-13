<?php

namespace Dotdigital\V3\Models\Contact\Import;

use Dotdigital\V3\Models\AbstractSingletonModel;

class FailureDetail extends AbstractSingletonModel
{
    /**
     * @var string
     */
    protected string $failureCode;

    /**
     * @var string
     */
    protected string $description;

    /**
     * @param string $failureCode
     * @return void
     */
    public function setFailureCode(string $failureCode): void
    {
        $this->failureCode = $failureCode;
    }

    /**
     * @param string $description
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}
