<?php

namespace Dotdigital\HttpClient\Message\V3;

use Dotdigital\Exception\ResponseValidationException;
use Psr\Http\Message\ResponseInterface;

class ResponseMediator
{
    /**
     * @param ResponseInterface $response
     *
     * @return string
     * @throws ResponseValidationException
     */
    public static function getContent(ResponseInterface $response)
    {
        $content = $response->getBody()->getContents();

        if (!json_decode($content)) {
            throw new ResponseValidationException('Cannot decode response.');
        }

        $decoded = json_decode($content, true);

        if (isset($decoded['errorCode'])) {
            throw new ResponseValidationException($decoded['description']);
        }

        return $content;
    }
}
