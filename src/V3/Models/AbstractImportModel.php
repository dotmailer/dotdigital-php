<?php

namespace Dotdigital\V3\Models;

use Dotdigital\V3\Models\Import\Failure\FailureCollection;
use Dotdigital\V3\Models\Import\SummaryInterface;

abstract class AbstractImportModel extends AbstractSingletonModel
{
    /**
     * @var string
     */
    protected $importId;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var SummaryInterface
     */
    protected $summary;

    /**
     * @var FailureCollection
     */
    protected $failures;

    /**
     * @param array $failuresData
     * @return FailureCollection
     * @throws \Exception
     */
    abstract public function createFailures(array $failuresData): FailureCollection;

    /**
     * @param array $summary
     * @return void
     * @throws \Exception
     */
    abstract public function setSummary(array $summary): void;

    /**
     * @param string $importId
     * @return void
     */
    public function setImportId(string $importId): void
    {
        $this->importId = $importId;
    }

    /**
     * @param string $status
     * @return void
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @param array $failures
     * @return void
     * @throws \Exception
     */
    public function setFailures(array $failures): void
    {
        $this->failures = $this->createFailures($failures);
    }
}
