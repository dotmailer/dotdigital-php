<?php

namespace Dotdigital\V3\Utility\Pagination;

use Dotdigital\V3\Models\Collection;

class ParameterCollection extends Collection
{
    /**
     * @param $key
     * @param $value
     * @return $this
     * @throws \Exception
     */
    public function setParam($key, $value): self
    {
        $this->set(
            $key,
            new Parameter([
                'field' => $key,
                'value' => $value
            ])
        );

        return $this;
    }

    /**
     * @return string
     */
    public function toQueryString(): string
    {
        return http_build_query(
            array_reduce(
                $this->all(),
                function (array $carry, Parameter $item) {
                    $carry[$item->getField()] = $item->getValue();
                    return $carry;
                },
                []
            )
        );
    }

    /**
     * @return string|null
     */
    protected function getExpectedClass(): ?string
    {
        return Parameter::class;
    }
}
