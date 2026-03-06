<?php

namespace Dotdigital\V2\Models;

/**
 * @property int $id
 * @property string $name
 * @property int $contacts
 */
class Segment extends AbstractSingletonModel
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $contacts;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getContacts()
    {
        return $this->contacts;
    }
}
