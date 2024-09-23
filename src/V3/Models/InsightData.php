<?php

declare(strict_types=1);

namespace Dotdigital\V3\Models;

use Dotdigital\V3\Models\InsightData\Record;
use Dotdigital\V3\Models\InsightData\RecordsCollection;

class InsightData extends AbstractSingletonModel
{
    /**
     * @var string
     */
    protected string $collectionName;

    /**
     * @var string
     */
    protected string $collectionScope;

    /**
     * @var string
     */
    protected string $collectionType;

    /**
     * @var RecordsCollection
     */
    protected RecordsCollection $records;

    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function setRecords(array $data)
    {
        $recordsCollection = new RecordsCollection();
        foreach ($data as $array) {
            $record = new Record($array);
            $recordsCollection->add($record);
        }
        $this->records = $recordsCollection;
    }
}
