<?php

namespace Dotdigital\V3\Utility\Pagination;

interface PageableResourceInterface
{
    /**
     * @param ParameterCollection $parameterCollection
     * @return string
     * @throws \Exception
     */
    public function getPaged(ParameterCollection $parameterCollection): string;
}
