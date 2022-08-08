<?php

declare(strict_types=1);

namespace Dotdigital\Resources;

use Dotdigital\Client;

/**
 * Factory class for API resources.
 *
 */
class ResourceFactory
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var array<string, AbstractResource>
     */
    private $resources;

    /**
     * @var array<string, string>
     */
    private static $classMap = [
        'accountInfo' => AccountInfo::class,
        'programs' => Programs::class,
        'addressBooks' => AddressBooks::class,
        'dataFields' => DataFields::class,
        'contacts' => Contacts::class,
    ];

    /**
     * ResourceFactory constructor.
     *
     * @param Client $client
     */
    public function __construct($client)
    {
        $this->client = $client;
        $this->resources = [];
    }

    /**
     * @param string $name
     *
     * @return null|AbstractResource
     */
    public function __get($name)
    {
        $resourceClass = $this->getResourceClass($name);
        if (null !== $resourceClass) {
            if (!\array_key_exists($name, $this->resources)) {
                $this->resources[$name] = new $resourceClass($this->client);
            }

            return $this->resources[$name];
        }

        \trigger_error('Undefined property: ' . static::class . '::$' . $name);

        return null;
    }

    /**
     * @param string $name
     *
     * @return string|null
     */
    protected function getResourceClass($name)
    {
        return \array_key_exists($name, self::$classMap) ? self::$classMap[$name] : null;
    }
}
