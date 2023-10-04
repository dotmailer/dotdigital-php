<?php

namespace Dotdigital\V2\Models;

class Survey extends AbstractSingletonModel
{
    /**
     * @var int
     */
    protected int $id;

    /**
     * @var string
     */
    protected string $name;

    /**
     * @var string|null
     */
    protected ?string $url;

    /**
     * @var string
     */
    protected string $dateSurveyCreated;

    /**
     * @var string|null
     */
    protected ?string $dateSurveyModified;

    /**
     * @var string|null
     */
    protected ?string $state;

    /**
     * @var string|null
     */
    protected ?string $firstActiveDate;

    /**
     * @var string|null
     */
    protected ?string $lastInactiveDate;

    /**
     * @var string|null
     */
    protected ?string $scheduledStartDate;

    /**
     * @var string|null
     */
    protected ?string $scheduledEndDate;

    /**
     * @var string|null
     */
    protected ?string $confirmationMode;

    /**
     * @var string|null
     */
    protected ?string $submissionMode;

    /**
     * @var int|null
     */
    protected ?int $fieldCount;

    /**
     * @var bool
     */
    protected bool $notifyCreatorOnResponse;

    /**
     * @var string|null
     */
    protected ?string $respondentNotificationType;

    /**
     * @var string|null
     */
    protected ?string $respondentNotificationCampaignId;

    /**
     * @var bool
     */
    protected bool $isAssignedToAddressBook;

    /**
     * @var string|null
     */
    protected ?string $assignedAddressBookTarget;

    /**
     * @var int|null
     */
    protected ?int $assignedSpecificAddressBookId;

    /**
     * @var string|null
     */
    protected ?string $firstResponseDate;

    /**
     * @var string|null
     */
    protected ?string $lastResponseDate;

    /**
     * @var int|null
     */
    protected ?int $totalCompleteResponses;

    /**
     * @var int|null
     */
    protected ?int $totalCompleteResponsesInLastDay;

    /**
     * @var int|null
     */
    protected ?int $totalCompleteResponsesInLastWeek;

    /**
     * @var int|null
     */
    protected ?int $totalIncompleteResponses;

    /**
     * @var int|null
     */
    protected ?int $totalViews;

    /**
     * @var int|null
     */
    protected ?int $totalBounces;

    /**
     * @var int|null
     */
    protected ?int $timeToCompleteMax;

    /**
     * @var int|null
     */
    protected ?int $timeToCompleteMin;

    /**
     * @var int|null
     */
    protected ?int $timeToCompleteTotal;

    /**
     * @var int|null
     */
    protected ?int $sourceDirectTotal;

    /**
     * @var int|null
     */
    protected ?int $sourceEmailTotal;

    /**
     * @var int|null
     */
    protected ?int $sourceEmbeddedTotal;

    /**
     * @var int|null
     */
    protected ?int $sourcePopoverTotal;

    /**
     * @var int|null
     */
    protected ?int $sourceFacebookTotal;

    /**
     * @var int|null
     */
    protected ?int $sourceTwitterTotal;

    /**
     * @var int|null
     */
    protected ?int $sourceGooglePlusTotal;

    /**
     * @var int|null
     */
    protected ?int $sourceOtherTotal;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string|null
     */
    public function getAssignedAddressBookTarget(): ?string
    {
        return $this->assignedAddressBookTarget;
    }

    /**
     * @return int|null
     */
    public function getAssignedSpecificAddressBookId(): ?int
    {
        return $this->assignedSpecificAddressBookId;
    }

    /**
     * @return string|null
     */
    public function getConfirmationMode(): ?string
    {
        return $this->confirmationMode;
    }

    /**
     * @return string
     */
    public function getDateSurveyCreated(): string
    {
        return $this->dateSurveyCreated;
    }

    /**
     * @return string|null
     */
    public function getDateSurveyModified(): ?string
    {
        return $this->dateSurveyModified;
    }

    /**
     * @return int|null
     */
    public function getFieldCount(): ?int
    {
        return $this->fieldCount;
    }

    /**
     * @return string|null
     */
    public function getFirstActiveDate(): ?string
    {
        return $this->firstActiveDate;
    }

    /**
     * @return string|null
     */
    public function getFirstResponseDate(): ?string
    {
        return $this->firstResponseDate;
    }

    /**
     * @return string|null
     */
    public function getLastInactiveDate(): ?string
    {
        return $this->lastInactiveDate;
    }

    /**
     * @return string|null
     */
    public function getLastResponseDate(): ?string
    {
        return $this->lastResponseDate;
    }

    /**
     * @return string|null
     */
    public function getRespondentNotificationCampaignId(): ?string
    {
        return $this->respondentNotificationCampaignId;
    }

    /**
     * @return string|null
     */
    public function getRespondentNotificationType(): ?string
    {
        return $this->respondentNotificationType;
    }

    /**
     * @return string|null
     */
    public function getScheduledEndDate(): ?string
    {
        return $this->scheduledEndDate;
    }

    /**
     * @return string|null
     */
    public function getScheduledStartDate(): ?string
    {
        return $this->scheduledStartDate;
    }

    /**
     * @return int|null
     */
    public function getSourceDirectTotal(): ?int
    {
        return $this->sourceDirectTotal;
    }

    /**
     * @return int|null
     */
    public function getSourceEmailTotal(): ?int
    {
        return $this->sourceEmailTotal;
    }

    /**
     * @return int|null
     */
    public function getSourceEmbeddedTotal(): ?int
    {
        return $this->sourceEmbeddedTotal;
    }

    /**
     * @return int|null
     */
    public function getSourceFacebookTotal(): ?int
    {
        return $this->sourceFacebookTotal;
    }

    /**
     * @return int|null
     */
    public function getSourceGooglePlusTotal(): ?int
    {
        return $this->sourceGooglePlusTotal;
    }

    /**
     * @return int|null
     */
    public function getSourceOtherTotal(): ?int
    {
        return $this->sourceOtherTotal;
    }

    /**
     * @return int|null
     */
    public function getSourcePopoverTotal(): ?int
    {
        return $this->sourcePopoverTotal;
    }

    /**
     * @return int|null
     */
    public function getSourceTwitterTotal(): ?int
    {
        return $this->sourceTwitterTotal;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @return string|null
     */
    public function getSubmissionMode(): ?string
    {
        return $this->submissionMode;
    }

    /**
     * @return int|null
     */
    public function getTimeToCompleteMax(): ?int
    {
        return $this->timeToCompleteMax;
    }

    /**
     * @return int|null
     */
    public function getTimeToCompleteMin(): ?int
    {
        return $this->timeToCompleteMin;
    }

    /**
     * @return int|null
     */
    public function getTimeToCompleteTotal(): ?int
    {
        return $this->timeToCompleteTotal;
    }

    /**
     * @return int|null
     */
    public function getTotalBounces(): ?int
    {
        return $this->totalBounces;
    }

    /**
     * @return int|null
     */
    public function getTotalCompleteResponses(): ?int
    {
        return $this->totalCompleteResponses;
    }

    /**
     * @return int|null
     */
    public function getTotalCompleteResponsesInLastDay(): ?int
    {
        return $this->totalCompleteResponsesInLastDay;
    }

    /**
     * @return int|null
     */
    public function getTotalCompleteResponsesInLastWeek(): ?int
    {
        return $this->totalCompleteResponsesInLastWeek;
    }

    /**
     * @return int|null
     */
    public function getTotalIncompleteResponses(): ?int
    {
        return $this->totalIncompleteResponses;
    }

    /**
     * @return int|null
     */
    public function getTotalViews(): ?int
    {
        return $this->totalViews;
    }

    /**
     * @return bool
     */
    public function isAssignedToAddressBook(): bool
    {
        return $this->isAssignedToAddressBook;
    }

    /**
     * @return bool
     */
    public function isNotifyCreatorOnResponse(): bool
    {
        return $this->notifyCreatorOnResponse;
    }
}
