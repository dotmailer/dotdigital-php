<?php

namespace Dotdigital\V3\Utility\Pagination;

use Dotdigital\V3\Models\Collection;

class LinkCollection extends Collection
{
    protected function getExpectedClass(): ?string
    {
        return Link::class;
    }

    /**
     * @param string $key
     * @return Link|null
     */
    public function getLink(string $key): ?Link
    {
        return $this->items[$key] ?? null;
    }

    /**
     * @param object $item
     */
    public function add($item): void
    {
        throw new \BadMethodCallException('Use set() instead');
    }

    /**
     * @param string|int $key
     * @param object $item
     */
    public function set($key, $item): void
    {
        $this->validateType($item);

        if (is_string($key) || is_int($key)) {
            $this->items[$key] = $item;
        } else {
            throw new \InvalidArgumentException('Keys must be string or integer');
        }
    }
}
