<?php

namespace Dotdigital\Tests\V2\Integration\Resources;

use Dotdigital\AbstractClient;
use Dotdigital\Tests\ApiConfigurationTrait;
use Dotdigital\V2\Client;
use Dotdigital\V2\Resources\Surveys;
use PHPUnit\Framework\TestCase;

class SurveysTest extends TestCase
{
    use ApiConfigurationTrait;

    protected string $resourceBase = Surveys::RESOURCE_BASE;

    protected AbstractClient $client;

    public function setUp(): void
    {
        $this->client = new Client();
        $this->clientInit();
    }

    public function testSurveyContent()
    {
        $surveys = $this->client->surveys->show();

        foreach ($surveys->getList() as $survey) {
            $this->assertObjectHasProperty('id', $survey);
            $this->assertObjectHasProperty('name', $survey);
            $this->assertObjectHasProperty('url', $survey);
            $this->assertObjectHasProperty('dateSurveyCreated', $survey);
            $this->assertObjectHasProperty('dateSurveyModified', $survey);
            $this->assertObjectHasProperty('state', $survey);
            $this->assertObjectHasProperty('firstActiveDate', $survey);
            $this->assertObjectHasProperty('lastInactiveDate', $survey);
            $this->assertObjectHasProperty('scheduledStartDate', $survey);
            $this->assertObjectHasProperty('scheduledEndDate', $survey);
            $this->assertObjectHasProperty('confirmationMode', $survey);
            $this->assertObjectHasProperty('submissionMode', $survey);
            $this->assertObjectHasProperty('fieldCount', $survey);
            $this->assertObjectHasProperty('notifyCreatorOnResponse', $survey);
            $this->assertObjectHasProperty('respondentNotificationType', $survey);
            $this->assertObjectHasProperty('respondentNotificationCampaignId', $survey);
            $this->assertObjectHasProperty('isAssignedToAddressBook', $survey);
            $this->assertObjectHasProperty('assignedAddressBookTarget', $survey);
            $this->assertObjectHasProperty('assignedSpecificAddressBookId', $survey);
            $this->assertObjectHasProperty('firstResponseDate', $survey);
            $this->assertObjectHasProperty('lastResponseDate', $survey);
            $this->assertObjectHasProperty('totalCompleteResponses', $survey);
            $this->assertObjectHasProperty('totalCompleteResponsesInLastDay', $survey);
            $this->assertObjectHasProperty('totalCompleteResponsesInLastWeek', $survey);
            $this->assertObjectHasProperty('totalIncompleteResponses', $survey);
            $this->assertObjectHasProperty('totalViews', $survey);
            $this->assertObjectHasProperty('totalBounces', $survey);
            $this->assertObjectHasProperty('timeToCompleteMax', $survey);
            $this->assertObjectHasProperty('timeToCompleteMin', $survey);
            $this->assertObjectHasProperty('timeToCompleteTotal', $survey);
            $this->assertObjectHasProperty('sourceDirectTotal', $survey);
            $this->assertObjectHasProperty('sourceEmailTotal', $survey);
            $this->assertObjectHasProperty('sourceEmbeddedTotal', $survey);
            $this->assertObjectHasProperty('sourcePopoverTotal', $survey);
            $this->assertObjectHasProperty('sourceFacebookTotal', $survey);
            $this->assertObjectHasProperty('sourceTwitterTotal', $survey);
            $this->assertObjectHasProperty('sourceGooglePlusTotal', $survey);
            $this->assertObjectHasProperty('sourceOtherTotal', $survey);
        }
    }
}
