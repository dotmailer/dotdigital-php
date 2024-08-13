<?php

namespace Dotdigital\V3\Models\Contact;

use Dotdigital\V3\Models\AbstractSingletonModel;

class Preference extends AbstractSingletonModel
{
    /**
     * @var string|null
     */
    protected ?string $publicName;

    /**
     * @var string|null
     */
    protected ?string $privateName;

    /**
     * @var int|null
     */
    protected ?int $id;

    /**
     * @var bool|null
     */
    protected ?bool $isOptedIn;

    /**
     * @param int $id
     *
     * @return self
     */
    public function setId(int $id): Preference
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param bool $isOptedIn
     *
     * @return self
     */
    public function setIsOptedIn(bool $isOptedIn): Preference
    {
        $this->isOptedIn = $isOptedIn;
        return $this;
    }
}
