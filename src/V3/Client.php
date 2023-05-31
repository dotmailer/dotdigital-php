<?php

namespace Dotdigital\V3;

use Dotdigital\AbstractClient;
use Dotdigital\Exception\ResponseValidationException;
use Dotdigital\HttpClient\Message\V3\ResponseMediator;
use Psr\Http\Message\ResponseInterface;

/**
 * @property \Dotdigital\V3\Resources\Contacts $contacts
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
