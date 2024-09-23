<?php

namespace Dotdigital\V3\Models\InsightData;

use Dotdigital\V3\Models\AbstractImportModel;
use Dotdigital\V3\Models\Import\Failure\FailureCollection;
use Dotdigital\V3\Models\Import\ImportInterface;
use Dotdigital\V3\Models\Import\SummaryInterface;
use Dotdigital\V3\Models\InsightData\Import\Failure;
use Dotdigital\V3\Models\InsightData\Import\Summary;

class Import extends AbstractImportModel implements ImportInterface
{
    /**
     * @var string
     */
    protected $collectionName;

    /**
     * @param array $failuresData
     * @return FailureCollection
     * @throws \Exception
     */
    public function createFailures(array $failuresData): FailureCollection
    {
        $failures = new FailureCollection();
        foreach ($failuresData as $failureData) {
            $failure = new Failure($failureData);
            $failures->add($failure);
        }
        return $failures;
    }

    /**
     * @param array $summary
     * @return void
     * @throws \Exception
     */
    public function setSummary(array $summary): void
    {
        $this->summary = new Summary($summary);
    }

    /**
     * @return SummaryInterface
     */
    public function getSummary(): SummaryInterface
    {
        return $this->summary;
    }

    /**
     * @inheritDoc
     */
    public function getFailures(): ?FailureCollection
    {
        return $this->failures;
    }

    /**
     * @inheritDoc
     */
    public function getImportId(): string
    {
        return $this->importId;
    }

    /**
     * @inheritDoc
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}
