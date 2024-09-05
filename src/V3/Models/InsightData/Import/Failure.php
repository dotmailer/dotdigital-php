<?php

namespace Dotdigital\V3\Models\InsightData\Import;

use Dotdigital\Exception\ValidationException;
use Dotdigital\V3\Models\AbstractSingletonModel;
use Dotdigital\V3\Models\Contact\Identifiers;
use Dotdigital\V3\Models\Contact\Import\Failure\FailureDetail;
use Dotdigital\V3\Models\Contact\Import\Failure\FailureDetailCollection;
use Dotdigital\V3\Models\Import\FailureCollectionInterface;
use Dotdigital\V3\Models\Import\FailureInterface;
use Dotdigital\V3\Models\InsightData\CollectionOwner;
use Dotdigital\V3\Models\InsightData\Record;

class Failure extends AbstractSingletonModel implements FailureInterface
{
    /**
     * @var int
     */
    protected int $contactId;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var mixed
     */
    protected $json;

    /**
     * @var CollectionOwner|mixed
     */
    protected $collectionOwner;

    /**
     * @var string
     */
    protected $failureReason;

    /**
     * @param $collectionOwner
     * @return void
     * @throws ValidationException
     */
    public function setCollectionOwner($collectionOwner): void
    {
        if (is_array($collectionOwner)) {
            $collectionOwner = new CollectionOwner($collectionOwner);
        }

        if (!is_a($collectionOwner, CollectionOwner::class)) {
            throw new ValidationException(
                "{$collectionOwner} must be an instance of " . CollectionOwner::class
            );
        }

        $this->collectionOwner = $collectionOwner;
    }

    /**
     * @return CollectionOwner
     */
    public function getCollectionOwner(): CollectionOwner
    {
        return $this->collectionOwner;
    }
}
