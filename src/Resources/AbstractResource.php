<?php

declare(strict_types=1);

namespace Dotdigital\Resources;

use Dotdigital\AbstractClient;
use Dotdigital\Exception\ResponseValidationException;

abstract class AbstractResource
{
    /**
     * The client instance.
     *
     * @var AbstractClient
     */
    private $client;

    /**
     * Create a new API instance.
     *
     * @param AbstractClient $client
     *
     * @return void
     */
    public function __construct(AbstractClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $path
     *
     * @return string
     * @throws \Http\Client\Exception
     */
    protected function get($path)
    {
        $response = $this->client->getHttpClient()->get($path);
        return $this->client->mediateResponse($response);
    }

    /**
     * @param string $path
     * @param array<mixed> $body
     * @param array<mixed> $headers
     *
     * @return string
     * @throws ResponseValidationException
     * @throws \Http\Client\Exception
     */
    protected function post(string $path, array $body = [], array $headers = [])
    {
        $response = $this->client->getHttpClient()->post(
            $path,
            $headers,
            json_encode($body)
        );

        return $this->client->mediateResponse($response);
    }

    /**
     * @param string $path
     * @param array $body
     * @param array $headers
     *
     * @return string
     * @throws ResponseValidationException
     * @throws \Http\Client\Exception
     */
    protected function put(string $path, array $body = [], array $headers = [])
    {
        $response = $this->client->getHttpClient()->put(
            $path,
            $headers,
            json_encode($body)
        );

        return $this->client->mediateResponse($response);
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
