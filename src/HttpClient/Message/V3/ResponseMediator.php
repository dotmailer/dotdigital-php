<?php

namespace Dotdigital\HttpClient\Message\V3;

use Dotdigital\Exception\ResponseValidationException;
use Dotdigital\Exception\TooManyRequestsException;
use Psr\Http\Message\ResponseInterface;

class ResponseMediator
{
    /**
     * @param ResponseInterface $response
     *
     * @return string
     * @throws ResponseValidationException|TooManyRequestsException
     */
    public static function getContent(ResponseInterface $response)
    {
        switch ($response->getStatusCode()) {
            case 200:
            case 201:
            case 202:
            case 204:
                return $response->getBody()->getContents();
            case 429:
                throw TooManyRequestsException::fromErrorResponse($response);
            default:
                throw ResponseValidationException::fromErrorResponse($response);
        }
    }
}
