<?php

namespace Dotdigital\V3\Models\Import;

use Dotdigital\V3\Models\Import\Failure\FailureCollection;

interface ImportInterface
{
    /**
     * @param array $failuresData
     * @return FailureCollection
     */
    public function createFailures(array $failuresData): FailureCollection;

    /**
     * @param array $summary
     * @return void
     */
    public function setSummary(array $summary): void;

    /**
     * @param string $importId
     * @return void
     */
    public function setImportId(string $importId): void;

    /**
     * @param string $status
     * @return void
     */
    public function setStatus(string $status): void;

    /**
     * @param array $failures
     * @return void
     */
    public function setFailures(array $failures): void;

    /**
     * @return SummaryInterface
     */
    public function getSummary(): SummaryInterface;

    /**
     * @return string
     */
    public function getImportId(): string;

    /**
     * @return FailureCollection|null
     */
    public function getFailures(): ?FailureCollection;

    /**
     * @return string
     */
    public function getStatus(): string;
}
