<?php

namespace Dotdigital\V2\Resources;

use Dotdigital\Resources\AbstractResource;
use Dotdigital\V2\Models\SurveyList;

class Surveys extends AbstractResource
{
    public const RESOURCE_BASE = '/surveys';
    public const SELECT_LIMIT = 500;

    /**
     * @param string $assignedToAddressBookOnly
     * @param int $select
     * @param int $skip
     * @return SurveyList
     * @throws \Http\Client\Exception
     */
    public function show(string $assignedToAddressBookOnly = 'false', int $select = self::SELECT_LIMIT, int $skip = 0)
    {
        $uriParams = sprintf(
            '?assignedToAddressBookOnly=%s&select=%s&skip=%s',
            $assignedToAddressBookOnly,
            $select,
            $skip
        );

        return new SurveyList($this->get(self::RESOURCE_BASE . $uriParams));
    }
}
