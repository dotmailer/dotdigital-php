<?php

declare(strict_types=1);

namespace Dotdigital\Resources;

use Dotdigital\AbstractClient;

/**
 * Factory class for API resources.
 */
class ResourceFactory
{
    /**
     * @var AbstractClient
     */
    private $client;

    /**
     * ResourceFactory constructor.
     *
     * @param AbstractClient $client
     */
    public function __construct(AbstractClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $className
     * @return null|AbstractResource
     */
    public function __get(string $className)
    {
        if (class_exists($className)) {
            return new $className($this->client);
        }

        \trigger_error('Undefined property: ' . static::class . '::$' . $className);

        return null;
    }
}
