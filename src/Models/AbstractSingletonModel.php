<?php

declare(strict_types=1);

namespace Dotdigital\Models;

use Dotdigital\Exception\ResponseValidationException;

class AbstractSingletonModel
{
    /**
     * AbstractModel constructor.
     *
     * @param string|array<mixed> $content
     *
     * @throws \Exception
     */
    public function __construct(
        $content
    ) {
        $this->validate($content);
    }

    /**
     * @param string|array<mixed> $content
     *
     * @return void
     * @throws ResponseValidationException
     */
    protected function validate($content)
    {
        if (is_string($content) && json_decode($content)) {
            $content = json_decode($content, true);
        }
        $properties = $this->getModelProperties();
        foreach ($content as $key => $value) {
            if (!empty($properties)) {
                if (!array_key_exists($key, $properties)) {
                    throw new ResponseValidationException(
                        sprintf('Response validation error: missing key %s', $key)
                    );
                }
                if (is_array($properties[$key])) {
                    $method = 'get' . ucfirst($key) . 'List';
                    if (method_exists($this, $method)) {
                        $this->$method($value);
                    }
                }
            }
            try {
                /** @throws \TypeError */
                $this->$key = $value;
            } catch (\TypeError $e) {
                throw new ResponseValidationException($e->getMessage());
            }
        }
    }

    /**
     * @return array<mixed>
     */
    private function getModelProperties()
    {
        return get_class_vars(get_class($this));
    }
}
