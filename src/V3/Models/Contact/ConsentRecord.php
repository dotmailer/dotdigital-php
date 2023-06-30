<?php

namespace Dotdigital\V3\Models\Contact;

use Dotdigital\Exception\ValidationException;
use Dotdigital\V3\Models\AbstractSingletonModel;

class ConsentRecord extends AbstractSingletonModel
{
    /**
     * @var string|null
     */
    protected ?string $text;

    /**
     * @var string
     */
    protected string $dateTimeConsented;

    /**
     * @var string|null
     */
    protected ?string $url;

    /**
     * @var string|null
     */
    protected ?string $ipAddress;

    /**
     * @var string|null
     */
    protected ?string $userAgent;

    /**
     * @var string|null
     */
    protected ?string $dateTimeCreated;

    /**
     * Cast date time to string
     *
     * @param string $dateTimeConsented
     * @return self
     * @throws \Exception
     */
    public function setDateTimeConsented(string $dateTimeConsented): self
    {
        $this->dateTimeConsented = $this->validateDateTime($dateTimeConsented);
        return $this;
    }

    /**
     * @param string $value
     * @return string
     * @throws ValidationException
     */
    private function validateDateTime(string $value): string
    {
        try {
            $value = \Carbon\Carbon::parse($value)->toIso8601String();
        } catch (\Exception $e) {
            throw new ValidationException("Invalid date format for dateTimeConsented field, expected ISO8601 format");
        }

        return $value;
    }
}
