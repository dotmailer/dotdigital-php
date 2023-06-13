<?php

namespace Dotdigital\V3\Models\Contact;

use Dotdigital\V3\Models\AbstractSingletonModel;
use Dotdigital\V3\Models\Contact;
use Dotdigital\V3\Models\Contact\Import\Failure;
use Dotdigital\V3\Models\Contact\Import\FailureCollection;
use Dotdigital\V3\Models\Contact\Import\Summary;
use Dotdigital\V3\Models\ContactCollection;

class Import extends AbstractSingletonModel
{
    /**
     * @var string
     */
    protected $importId;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var Summary
     */
    protected $summary;

    /**
     * @var ContactCollection
     */
    protected $created;

    /**
     * @var ContactCollection
     */
    protected $updated;

    /**
     * @var FailureCollection
     */
    protected $failures;

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
     * @param array $failuresData
     * @return FailureCollection
     * @throws \Exception
     */
    private function createFailures(array $failuresData): FailureCollection
    {
        $failures = new FailureCollection();
        foreach ($failuresData as $failureData) {
            $failure = new Failure($failureData);
            $failures->add($failure);
        }
        return $failures;
    }

    /**
     * @param string $importId
     * @return void
     */
    public function setImportId(string $importId): void
    {
        $this->importId = $importId;
    }

    /**
     * @param string $status
     * @return void
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @param array $summary
     * @return void
     * @throws \Exception
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
     * @param array $failures
     * @return void
     * @throws \Exception
     */
    public function setFailures(array $failures): void
    {
        $this->failures = $this->createFailures($failures);
    }
}
