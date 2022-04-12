<?php

namespace Dotdigital\Models;

interface ListInterface
{
    /**
     * @param array<mixed> $listItem
     *
     * @return mixed
     */
    public function getOne(array $listItem);
}
