<?php

declare(strict_types=1);

namespace Dotdigital\V2\Models;

use Dotdigital\Exception\ResponseValidationException;
use Dotdigital\Models\AbstractModel;
use Dotdigital\V2\Models\AbstractSingletonModel;

abstract class AbstractListModel extends AbstractModel
{
    /**
     * @var array
     */
    protected array $data = [];

    /**
     * AbstractListModel constructor.
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
     * @param array $listItem
     *
     * @return AbstractSingletonModel
     */
    abstract protected function getOne(array $listItem);

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
        foreach ($content ?? [] as $key => $value) {
            if ($this->ignoreKey($key)) {
                continue;
            }
            $this->data[$key] = $this->getOne($value);
        }
    }

    /**
     * @return array
     */
    public function getList()
    {
        return $this->data;
    }

    /**
     * Utility to return a list-type object as an array.
     *
     * @deprecated
     * @return array<mixed>
     */
    public function toArray()
    {
        return (array) $this;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function ignoreKey($key)
    {
        if (property_exists($this, 'ignore')) {
            return in_array($key, $this->ignore);
        };

        return false;
    }
}
