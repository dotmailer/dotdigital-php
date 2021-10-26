<?php

declare(strict_types=1);

namespace Dotdigital\Resource;

use Dotdigital\Client;
use Dotdigital\HttpClient\Message\ResponseMediator;

abstract class AbstractResource
{
	/**
	 * The client instance.
	 *
	 * @var Client
	 */
	private $client;

	/**
	 * Create a new API instance.
	 *
	 * @param Client $client
	 *
	 * @return void
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	protected function get(string $path)
	{
		$response = $this->client->getHttpClient()->get($path);
		return ResponseMediator::getContent($response);
	}

	protected function post($path, $body = null, array $headers = [])
    {
        $response = $this->client->getHttpClient()->post(
            $path,
            $headers,
            json_encode($body)
        );
        return ResponseMediator::getContent($response);
    }
}
