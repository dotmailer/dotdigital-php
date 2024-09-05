<?php

declare(strict_types=1);

namespace Dotdigital\V3\Resources;

use Dotdigital\Exception\ResponseValidationException;
use Dotdigital\Resources\AbstractResource;
use Dotdigital\V3\Models\InsightData as InsightDataModel;
use Dotdigital\V3\Models\InsightData\Import;
use Http\Client\Exception;

class InsightData extends AbstractResource
{
    public const RESOURCE_BASE = '/insightData/v3';

    /**
     * @param InsightDataModel $insightData
     * @return string
     * @throws \Dotdigital\Exception\ResponseValidationException
     * @throws \Http\Client\Exception
     */
    public function import(InsightDataModel $insightData): string
    {
        return $this->put(
            sprintf('%s/%s', self::RESOURCE_BASE, 'import'),
            json_decode(json_encode($insightData), true)
        );
    }

    /**
     * @param string $collectionName
     * @param string $recordId
     * @param array $insightData
     *
     * @return string
     * @throws ResponseValidationException
     * @throws Exception
     */
    public function createOrUpdateAccountCollectionRecord(
        string $collectionName,
        string $recordId,
        array $insightData
    ): string {
        return $this->put(
            sprintf(
                '%s/%s/%s/%s/',
                self::RESOURCE_BASE,
                'account',
                $collectionName,
                $recordId
            ),
            $insightData
        );
    }

    /**
     * @param string $collectionName
     * @param string $recordId
     * @param string $identifier
     * @param string $value
     * @param array $insightData
     *
     * @return string
     * @throws Exception
     * @throws ResponseValidationException
     */
    public function createOrUpdateContactCollectionRecord(
        string $collectionName,
        string $recordId,
        string $identifier,
        string $value,
        array $insightData
    ): string {
        return $this->put(
            sprintf(
                '%s/%s/%s/%s/%s/%s',
                self::RESOURCE_BASE,
                'contacts',
                $identifier,
                $value,
                $collectionName,
                $recordId
            ),
            $insightData
        );
    }

    /**
     * Retrieves the status of an insight data import request and the results if available.
     *
     * @param string $importId
     * @return Import
     * @throws Exception
     * @throws \Exception
     */
    public function getImportById(string $importId): Import
    {
        $response = $this->get(
            sprintf(
                '%s/%s/%s',
                self::RESOURCE_BASE,
                'import',
                $importId,
            )
        );
        return new Import($response);
    }
}
