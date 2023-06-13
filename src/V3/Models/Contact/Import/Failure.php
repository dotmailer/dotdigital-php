<?php

namespace Dotdigital\V3\Models\Contact\Import;

use Dotdigital\V3\Models\AbstractSingletonModel;
use Dotdigital\V3\Models\Contact\Identifier;

class Failure extends AbstractSingletonModel
{
    /**
     * @var Identifier
     */
    protected $identifiers;

    /**
     * @var FailureDetailCollection
     */
    protected $failures;

    /**
     * @param array $failureDetailsData
     * @return FailureDetailCollection
     * @throws \Exception
     */
    private function createFailureDetails(array $failureDetailsData): FailureDetailCollection
    {
        $failureDetails = new FailureDetailCollection();
        foreach ($failureDetailsData as $failureDetailData) {
            $failureDetail = new FailureDetail($failureDetailData);
            $failureDetails->add($failureDetail);
        }
        return $failureDetails;
    }

    /**
     * @param array $identifiers
     * @return void
     * @throws \Exception
     */
    public function setIdentifiers(array $identifiers): void
    {
        $this->identifiers = new Identifier($identifiers);
    }

    /**
     * @param array $failures
     * @return void
     * @throws \Exception
     */
    public function setFailures(array $failures): void
    {
        $this->failures = $this->createFailureDetails($failures);
    }
}
