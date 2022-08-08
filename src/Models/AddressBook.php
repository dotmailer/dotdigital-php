<?php

declare(strict_types=1);

namespace Dotdigital\Models;

/**
 * @property int $id
 * @property string $name
 * @property string $visibility
 * @property int $contacts
 */
class AddressBook extends AbstractSingletonModel
{
    /**
     * @var int
     */
    protected int $id;

    /**
     * @var string
     */
    protected string $name;

    /**
     * @var string
     */
    protected string $visibility;

    /**
     * @var int
     */
    protected int $contacts;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getVisibility(): string
    {
        return $this->visibility;
    }

    /**
     * @return int
     */
    public function getContacts(): int
    {
        return $this->contacts;
    }
}
