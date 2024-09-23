<?php

namespace Dotdigital\V3\Models\InsightData\Import;

use Dotdigital\V3\Models\AbstractSingletonModel;
use Dotdigital\V3\Models\Import\SummaryInterface;

class Summary extends AbstractSingletonModel implements SummaryInterface
{
    /**
     * @var int
     */
    protected $totalRecords;

    /**
     * @var int
     */
    protected $totalImported;

    /**
     * @var int
     */
    protected $totalRejected;
}
