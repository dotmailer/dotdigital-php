<?php

namespace Dotdigital\V3\Models\Contact\Import;

use Dotdigital\V3\Models\AbstractSingletonModel;

class Summary extends AbstractSingletonModel
{
    /**
     * @var int
     */
    protected $newContacts;

    /**
     * @var int
     */
    protected $updatedContacts;

    /**
     * @var int
     */
    protected $globallySuppressed;

    /**
     * @var int
     */
    protected $invalidEntries;

    /**
     * @var int
     */
    protected $duplicateIdentifiers;

    /**
     * @param int $newContacts
     * @return void
     */
    public function setNewContacts(int $newContacts): void
    {
        $this->newContacts = $newContacts;
    }

    /**
     * @param int $updatedContacts
     * @return void
     */
    public function setUpdatedContacts(int $updatedContacts): void
    {
        $this->updatedContacts = $updatedContacts;
    }

    /**
     * @param int $globallySuppressed
     * @return void
     */
    public function setGloballySuppressed(int $globallySuppressed): void
    {
        $this->globallySuppressed = $globallySuppressed;
    }

    /**
     * @param int $invalidEntries
     * @return void
     */
    public function setInvalidEntries(int $invalidEntries): void
    {
        $this->invalidEntries = $invalidEntries;
    }

    /**
     * @param int $duplicateIdentifiers
     * @return void
     */
    public function setDuplicateIdentifiers(int $duplicateIdentifiers): void
    {
        $this->duplicateIdentifiers = $duplicateIdentifiers;
    }
}
