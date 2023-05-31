<?php

declare(strict_types=1);

namespace Dotdigital\V2\Models;

/**
 * This is an object representing your Dotdigital account info.
 *
 * @property int $id
 * @property AccountInfoProperty[] $properties
 */
class AccountInfo extends AbstractSingletonModel
{
    /**
     * @var int
     */
    protected int $id;

    /**
     * @var AccountInfoProperty[]
     */
    protected array $properties;

    /**
     * @param array<mixed> $properties
     *
     * @return AccountInfoPropertyList
     * @throws \Exception
     */
    public function getPropertiesList(array $properties)
    {
        return new AccountInfoPropertyList($properties);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return AccountInfoProperty[]
     */
    public function getProperties(): array
    {
        return $this->properties;
    }
}
