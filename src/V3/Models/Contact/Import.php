<?php

namespace Dotdigital\V3\Models\Contact;

use Dotdigital\V3\Models\AbstractImportModel;
use Dotdigital\V3\Models\Contact;
use Dotdigital\V3\Models\Contact\Import\Failure;
use Dotdigital\V3\Models\Contact\Import\Summary;
use Dotdigital\V3\Models\ContactCollection;
use Dotdigital\V3\Models\Import\Failure\FailureCollection;
use Dotdigital\V3\Models\Import\ImportInterface;
use Dotdigital\V3\Models\Import\SummaryInterface;

/**
 * @method getCreated()
 * @method getUpdated()
 */
class Import extends AbstractImportModel implements ImportInterface
{
    /**
     * @var ContactCollection
     */
    protected $created;

    /**
     * @var ContactCollection
     */
    protected $updated;

    /**
     * @param array $contactsData
     * @return ContactCollection
     * @throws \Exception
     */
    private function createContactCollection(array $contactsData): ContactCollection
    {
        $contacts = new ContactCollection();
        foreach ($contactsData as $contactData) {
            $contact = new Contact($contactData);
            $contacts->add($contact);
        }
        return $contacts;
    }

    /**
     * @inheritDoc
     */
    public function createFailures(array $failuresData): FailureCollection
    {
        $failures = new FailureCollection();
        foreach ($failuresData as $failureData) {
            $failure = new Failure($failureData);
            $failures->add($failure);
        }
        return $failures;
    }

    /**
     * @inheritDoc
     */
    public function setSummary(array $summary): void
    {
        $this->summary = new Summary($summary);
    }

    /**
     * @param array $created
     * @return void
     * @throws \Exception
     */
    public function setCreated(array $created): void
    {
        $this->created = $this->createContactCollection($created);
    }

    /**
     * @param array $updated
     * @return void
     * @throws \Exception
     */
    public function setUpdated(array $updated): void
    {
        $this->updated = $this->createContactCollection($updated);
    }

    /**
     * @inheritDoc
     */
    public function getSummary(): ?SummaryInterface
    {
        return $this->summary;
    }

    /**
     * @inheritdoc
     */
    public function getFailures(): ?FailureCollection
    {
        return $this->failures;
    }

    /**
     * @inheritDoc
     */
    public function getImportId(): string
    {
        return $this->importId;
    }

    /**
     * @inheritDoc
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}
