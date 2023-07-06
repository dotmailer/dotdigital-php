<?php

declare(strict_types=1);

namespace Dotdigital\V3\Models;

use Dotdigital\Exception\ValidationException;
use JsonSerializable;

class AbstractSingletonModel implements JsonSerializable
{
    /**
     * AbstractSingletonModel constructor.
     *
     * @param string|array $content
     *
     * @throws \Exception
     */
    public function __construct(
        $content = []
    ) {
        $this->hydrate($content);
    }

    /**
     * @param string $property
     * @param array $args
     * @return mixed|null
     */
    public function __call(string $property, array $args)
    {
        $property = lcfirst(str_replace('get', '', $property));
        return (isset($this->$property)) ? $this->$property : null;
    }

    /**
     * @return array
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    /**
     * @param array|string $content
     *
     * @return $this
     * @throws ValidationException
     */
    protected function hydrate($content): AbstractSingletonModel
    {
        if (is_string($content) && json_decode($content)) {
            $content = json_decode($content, true);
        }

        foreach ($content as $property => $value) {
            try {
                $this->setProperty($property, $value);
            } catch (\TypeError $e) {
                throw new ValidationException($e->getMessage());
            }
        }

        return $this;
    }

    /**
     * @param string $property
     * @param mixed $value
     *
     * @return void
     */
    protected function setProperty($property, $value)
    {
        if (method_exists($this, $method = 'set' . ucfirst($property))) {
            $this->$method($value);
        } elseif (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}
