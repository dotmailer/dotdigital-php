<?php

namespace Dotdigital\Models;

use Dotdigital\Models\Contact\DataField as ContactDataField;
use Dotdigital\Models\Contact\DataFieldList as ContactDataFieldList;

class Contact extends AbstractSingletonModel
{
    /**
     * @var int
     */
    protected int $id;

    /**
     * @var string
     */
    protected string $email;

    /**
     * @var string
     */
    protected ?string $optInType;

    /**
     * @var string
     */
    protected ?string $emailType;

    /**
     * @var ContactDataField[]
     */
    protected ?array $dataFields;

    /**
     * @var string
     */
    protected string $status;

    /**
     * @param array<mixed> $properties
     *
     * @return ContactDataFieldList
     * @throws \Exception
     */
    public function getDataFieldsList(array $properties): ContactDataFieldList
    {
        return new ContactDataFieldList($properties);
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return ContactDataField[]
     */
    public function getDataFields(): ?array
    {
        return $this->dataFields;
    }

    /**
     * @return string
     */
    public function getEmailType(): ?string
    {
        return $this->emailType;
    }

    /**
     * @return string
     */
    public function getOptInType(): ?string
    {
        return $this->optInType;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
