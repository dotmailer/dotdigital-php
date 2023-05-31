<?php

namespace Dotdigital\V3\Models;

use ArrayIterator;
use Countable;
use Dotdigital\V3\Models\AbstractSingletonModel;
use IteratorAggregate;
use JsonSerializable;
use Traversable;

class Collection implements Countable, IteratorAggregate, JsonSerializable
{
    /**
     * @var array<mixed>
     */
    protected $items = [];

    /**
     * @param array<mixed> $items
     */
    public function __construct($items = [])
    {
        foreach ($items as $key => $item) {
            $this->set($key, $item);
        }
    }

    /**
     * @param mixed $item
     */
    public function add($item): void
    {
        $this->validateType($item);

        $this->items[] = $item;
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

    /**
     * @return false|string
     */
    public function __toString()
    {
        return $this->toJson();
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->items;
    }

    /**
     * @return array|mixed
     */
    public function first()
    {
        return $this->items[0] ?? [];
    }

    public function last()
    {
        $results = array_reverse($this->items);
        return $results[0] ?? [];
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * @param \Closure $callback
     *
     * @return $this
     */
    public function each($callback)
    {
        foreach ($this->items as $key => $value) {
            $callback($value, $key);
        }

        return $this;
    }

    /**
     * @param \Closure $callback
     *
     * @return self
     */
    final public function filter($callback = null)
    {
        if ($callback) {
            return new self(array_filter($this->items, $callback));
        }

        return new self(array_filter($this->items));
    }

    /**
     * @param \Closure $callback
     *
     * @return self
     */
    final public function map($callback)
    {
        $keys = array_keys($this->items);
        $items = array_map($callback, $this->items, $keys);

        return new self(array_combine($keys, $items));
    }

    /**
     * @param \Closure $callback
     * @param  mixed|null $initial
     *
     * @return mixed|null
     */
    public function reduce($callback, $initial = null)
    {
        return array_reduce($this->items, $callback, $initial);
    }

    /**
     * @return false|string
     */
    public function toJson()
    {
        return json_encode($this->items);
    }

    /**
     * @return ArrayIterator<int, AbstractSingletonModel>
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    /**
     * @return array
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return $this->items;
    }

    /**
     * @param object $item
     */
    protected function validateType($item): void
    {
        $expectedClass = $this->getExpectedClass();
        if ($expectedClass === null) {
            return;
        }

        if (!$item instanceof $expectedClass) {
            $elementClass = \get_class($item);

            throw new \InvalidArgumentException(
                sprintf('Expected collection element of type %s got %s', $expectedClass, $elementClass)
            );
        }
    }

    /**
     * @return string|null
     */
    protected function getExpectedClass(): ?string
    {
        return null;
    }
}
