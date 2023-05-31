<?php

namespace Dotdigital\V3\Models;

use Dotdigital\V3\Models\Contact\DataField;
use JsonSerializable;

class DataFieldCollection extends Collection implements JsonSerializable
{
    /**
     * @return string|null
     */
    protected function getExpectedClass(): ?string
    {
        return DataField::class;
    }

    /**
     * @return array
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        $preparedDataFields = [];
        foreach ($this->items as $item) {
            $preparedDataFields[$item->getKey()] = $item->getValue();
        }
        return $preparedDataFields;
    }
}
