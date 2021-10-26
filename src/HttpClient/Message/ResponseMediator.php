<?php

declare(strict_types=1);

namespace Dotdigital\HttpClient\Message;

use Psr\Http\Message\ResponseInterface;

final class ResponseMediator
{
    /**
     * @param ResponseInterface $response
     *
     * @return array|string
     */
	public static function getContent(ResponseInterface $response)
	{
	    $content = $response->getBody()->getContents();
	    if (json_decode($content)) {
            return json_decode($content, true);
        }

	    return $content;
	}
}
