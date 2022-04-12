<?php

declare(strict_types=1);

namespace Dotdigital\Models;

use Dotdigital\Models\Program;

class ProgramList extends AbstractListModel implements ListInterface
{
    /**
     * @param array<mixed> $listItem
     *
     * @return Program
     * @throws \Exception
     */
    public function getOne(array $listItem)
    {
        return new Program($listItem);
    }
}
