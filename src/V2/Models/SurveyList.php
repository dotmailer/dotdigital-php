<?php

namespace Dotdigital\V2\Models;

use Dotdigital\Models\ListInterface;

class SurveyList extends AbstractListModel implements ListInterface
{
    /**
     * @param array<mixed> $listItem
     *
     * @return Survey
     * @throws \Exception
     */
    public function getOne(array $listItem): Survey
    {
        return new Survey($listItem);
    }
}
