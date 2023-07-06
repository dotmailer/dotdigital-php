<?php

namespace Dotdigital\V3\Utility\Pagination;

use Dotdigital\Exception\ValidationException;
use Dotdigital\V3\Models\AbstractSingletonModel;

class Parameter extends AbstractSingletonModel
{
    /**
     * @var string
     */
    protected $field;

    /**
     * @var string
     */
    protected $value;

    /**
     * @param string $field
     * @return $this
     */
    public function setField(string $field): Parameter
    {
        $this->field = $field;
        return $this;
    }

    /**
     * @param string|int $value
     * @return $this
     * @throws ValidationException
     */
    public function setValue($value): Parameter
    {
        switch ($this->field) {
            case '~created':
            case '~modified':
                $this->value = 'gte::' . $this->validateDateTime($value);
                break;
            default:
                $this->value = $value;
        }
        return $this;
    }

    /**
     * @param $content
     * @return void
     * @throws ValidationException
     */
    public function validate($content): void
    {
        if (is_string($content) && json_decode($content)) {
            $content = json_decode($content, true);
        }

        if (is_array($content) && isset($content['field']) && isset($content['value'])) {
            $this->setField($content['field']);
            $this->setValue($content['value']);
        }
    }

    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return string
     * @throws ValidationException
     */
    private function validateDateTime(string $value): string
    {
        try {
            $value = \Carbon\Carbon::parse(
                str_replace('gte::', '', $value)
            )->toIso8601String();
        } catch (\Exception $e) {
            throw new ValidationException("Invalid date format for {$this->field} field, expected ISO8601 format");
        }

        return $value;
    }
}
