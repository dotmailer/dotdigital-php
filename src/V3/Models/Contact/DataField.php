<?php

namespace Dotdigital\V3\Models\Contact;

/**
 * This model does not extend from AbstractSingletonModel.
 * It is used to provide a validatable data structure for the 'OrderedMap' used by the API.
 */
class DataField
{
    /**
     * @var string
     */
    protected string $key;

    /**
     * @var string|int|float|null
     */
    protected $value;

    /**
     * @param string $key
     * @param $value
     */
    public function __construct(
        string $key,
        $value
    ) {
        $this->setKey($key);
        $this->setValue($value);
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key): self
    {
        $this->key = $key;

        return $this;
    }

    /**
     * @return string|int|float|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string|int|float|null $value
     */
    public function setValue($value): self
    {
        $this->value = $value;

        return $this;
    }
}
