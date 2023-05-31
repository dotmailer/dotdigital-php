<?php

declare(strict_types=1);

namespace Dotdigital\V3\Models;

use Dotdigital\Exception\ValidationException;
use JsonSerializable;

class AbstractSingletonModel implements JsonSerializable
{
    /**
     * AbstractModel constructor.
     *
     * @param string|array<mixed> $content
     *
     * @throws \Exception
     */
    public function __construct(
        $content = []
    ) {
        $this->validate($content);
    }

    /**
     * @param string $property
     * @param array<mixed> $args
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
     * @param string|array<mixed> $content
     *
     * @return void
     * @throws ValidationException
     */
    protected function validate($content)
    {
        if (is_string($content) && json_decode($content)) {
            $content = json_decode($content, true);
        }
        $properties = $this->getModelProperties();
        foreach ($content as $key => $value) {
            if (!empty($properties)) {
                if (!in_array($key, array_map(function ($property) {
                    return $property->name;
                }, $properties))) {
                    throw new ValidationException(
                        sprintf(
                            'Validation error: the key %s is not a property of %s',
                            $key,
                            $this->getModelName()
                        )
                    );
                }
            }
            try {
                if (method_exists($this, $method = 'set' . ucfirst($key))) {
                    $this->$method($value);
                } else {
                    $this->$key = $value;
                }
            } catch (\TypeError $e) {
                throw new ValidationException($e->getMessage());
            }
        }
    }

    /**
     * @return string
     */
    private function getModelName()
    {
        $model = new \ReflectionClass($this);
        return $model->getName();
    }

    /**
     * @return array<mixed>
     */
    protected function getModelProperties()
    {
        $model = new \ReflectionClass($this);
        return $model->getProperties();
    }
}
