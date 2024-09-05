<?php

namespace Dotdigital\V3\Models\InsightData;

use Dotdigital\Exception\ValidationException;
use Dotdigital\V3\Models\AbstractSingletonModel;

class CollectionOwner extends AbstractSingletonModel
{
    /**
     * @var string
     */
    protected $ownerType;

    /**
     * @var InsightDataIdentity
     */
    protected $identity;

    /**
     * @param string $ownerType
     * @return void
     */
    public function setOwnerType(string $ownerType): void
    {
        $this->ownerType = $ownerType;
    }

    /**
     * @param $identity
     * @return void
     * @throws ValidationException
     */
    public function setContactIdentity($identity): void
    {
        if (is_array($identity)) {
            $identity = new InsightDataIdentity($identity);
        }

        if (!is_a($identity, InsightDataIdentity::class)) {
            throw new ValidationException(
                "{$identity} must be an instance of " . InsightDataIdentity::class
            );
        }

        $this->identity = $identity;
    }
}
