<?php

namespace Dotdigital\HttpClient\Message\V3;

use Dotdigital\Exception\ResponseValidationException;
use Psr\Http\Message\ResponseInterface;

class ResponseMediator
{
    /**
     * @var int[] $passableStatusCodes
     */
    private static $passableStatusCodes = [
        200,
        201,
        202
    ];

    /**
     * @param ResponseInterface $response
     *
     * @return string
     * @throws ResponseValidationException
     */
    public static function getContent(ResponseInterface $response)
    {
        if (!in_array($response->getStatusCode(), self::$passableStatusCodes)) {
            throw ResponseValidationException::fromErrorResponse($response);
        }
        return $response->getBody()->getContents();
    }
}
