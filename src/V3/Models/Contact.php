<?php

namespace Dotdigital\V3\Models;

use Dotdigital\V3\Models\Contact\ChannelProperty;
use Dotdigital\V3\Models\Contact\ConsentRecord;
use Dotdigital\V3\Models\Contact\DataField;
use Dotdigital\V3\Models\Contact\Identifiers;
use Dotdigital\V3\Models\Contact\Preference;

class Contact extends AbstractSingletonModel
{
    /**
     * @var int
     */
    protected int $contactId;

    /**
     * @var string
     */
    protected string $status;

    /**
     * @var string|null
     */
    protected ?string $created;

    /**
     * @var string
     */
    protected ?string $updated;

    /**
     * @var string|null
     */
    protected ?string $matchIdentifier;

    /**
     * @var Identifiers|null
     */
    protected ?Identifiers $identifiers;

    /**
     * @var ChannelProperty|null
     */
    protected ?ChannelProperty $channelProperties;

    /**
     * @var DataFieldCollection|null
     */
    protected ?DataFieldCollection $dataFields;

    /**
     * @var array<int>|null
     */
    protected ?array $lists;

    /**
     * @var ConsentRecordCollection|null
     */
    protected ?ConsentRecordCollection $consentRecords;

    /**
     * @var PreferenceCollection|null
     */
    protected ?PreferenceCollection $preferences;

    public function getContactId(): int
    {
        return $this->contactId;
    }

    public function getIdentifiers(): Identifiers
    {
        return $this->identifiers;
    }

    /**
     * @param array<mixed> $data
     * @return void
     * @throws \Exception
     */
    public function setIdentifiers($data)
    {
        $this->identifiers = new Identifiers($data);
    }

    /**
     * @param $matchIdentifier
     * @return void
     */
    public function setMatchIdentifier($matchIdentifier): void
    {
        $this->matchIdentifier = $matchIdentifier;
    }

    /**
     * @param array<mixed> $data
     * @return void
     * @throws \Exception
     */
    public function setDataFields($data)
    {
        $dataFieldsCollection = new DataFieldCollection();
        foreach ($data as $key => $value) {
            $dataField = new DataField($key, $value);
            $dataFieldsCollection->add($dataField);
        }
        $this->dataFields = $dataFieldsCollection;
    }

    /**
     * @param array<mixed> $data
     * @return void
     * @throws \Exception
     */
    public function setChannelProperties(array $data)
    {
        $this->channelProperties = new ChannelProperty($data);
    }

    /**
     * @param array<int> $data
     * @return void
     * @throws \Exception
     */
    public function setLists(array $data)
    {
        $this->lists = $data;
    }

    /**
     * @param array<mixed> $data
     * @return void
     * @throws \Exception
     */
    public function setConsentRecords($data)
    {
        if (!isset($this->consentRecords)) {
            $this->consentRecords = new ConsentRecordCollection();
        }

        foreach ($data as $array) {
            $consentRecord = new ConsentRecord($array);
            $this->consentRecords->add($consentRecord);
        }
    }

    /**
     * @param array<mixed> $data
     * @return void
     * @throws \Exception
     */
    public function setPreferences($data)
    {
        $preferenceCollection = new PreferenceCollection();
        foreach ($data as $array) {
            $preference = new Preference($array);
            $preferenceCollection->add($preference);
        }
        $this->preferences = $preferenceCollection;
    }
}
