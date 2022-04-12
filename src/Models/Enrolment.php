<?php

declare(strict_types=1);

namespace Dotdigital\Models;

/**
 * @property string $id
 * @property int $programId
 * @property string $status
 * @property string $dateCreated
 * @property array $contacts
 * @property array $addressBooks
 */
class Enrolment extends AbstractSingletonModel
{
    /**
     * @var string
     */
    protected string $id;

    /**
     * @var int
     */
    protected int $programId;

    /**
     * @var string
     */
    protected string $status;

    /**
     * @var string
     */
    protected string $dateCreated;

    /**
     * @var array<mixed>
     */
    protected array $contacts;

    /**
     * @var array<mixed>
     */
    protected array $addressBooks;
}
