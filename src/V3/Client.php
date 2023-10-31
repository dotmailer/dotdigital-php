<?php

namespace Dotdigital\V3;

use Dotdigital\AbstractClient;
use Dotdigital\Exception\ResponseValidationException;
use Dotdigital\HttpClient\Message\V3\ResponseMediator;
use Dotdigital\V3\Resources\Contacts;
use Dotdigital\V3\Resources\InsightData;
use Psr\Http\Message\ResponseInterface;

/**
 * @property Contacts $contacts
 * @property InsightData $insightData
 */
class Client extends AbstractClient
{
    /**
     * @param ResponseInterface $response
     * @return string
     * @throws ResponseValidationException
     */
    public function mediateResponse($response): string
    {
        return ResponseMediator::getContent($response);
    }
}
