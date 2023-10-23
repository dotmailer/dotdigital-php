<?php

namespace Dotdigital\V3\Resources;

use Dotdigital\Exception\ResponseValidationException;
use Dotdigital\Resources\AbstractResource;
use Dotdigital\V3\Models\AbstractSingletonModel;
use Http\Client\Exception;

class InsightData extends AbstractResource
{
    public const RESOURCE_BASE = '/insightData/v3';

    /**
     * @param string $collectionName
     * @param string $recordId
     * @param array $insightData
     *
     * @return string
     * @throws ResponseValidationException
     * @throws Exception
     */
    public function createOrUpdateAccountCollection(
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
}
