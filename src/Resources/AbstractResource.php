<?php

declare(strict_types=1);

namespace Dotdigital\Resources;

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

    /**
     * @param string $path
     *
     * @return string
     * @throws \Http\Client\Exception
     */
    protected function get(string $path)
    {
        $response = $this->client->getHttpClient()->get($path);
        return ResponseMediator::getContent($response);
    }

    /**
     * @param string $path
     * @param array<mixed> $body
     * @param array<mixed> $headers
     *
     * @return string
     * @throws \Dotdigital\Exception\ResponseValidationException
     * @throws \Http\Client\Exception
     */
    protected function post($path, $body = [], array $headers = [])
    {
        $response = $this->client->getHttpClient()->post(
            $path,
            $headers,
            json_encode($body)
        );
        return ResponseMediator::getContent($response);
    }

    /**
     * Resolve data fields.
     *
     * Resolves data fields array to an accepted format.
     *
     * @param array<mixed> $dataFields
     * @return array<mixed>
     */
    protected function resolveDataFields(array $dataFields = [])
    {
        $objectArray = [];
        foreach ($dataFields as $key => $value) {
            $objectArray[] = [
                "key" => $key,
                "value" => $value
            ];
        }

        return $objectArray;
    }
}
