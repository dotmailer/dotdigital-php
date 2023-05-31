<?php

namespace Dotdigital\V2;

use Dotdigital\AbstractClient;
use Dotdigital\HttpClient\Message\V2\ResponseMediator;

/**
 * @property \Dotdigital\V2\Resources\AccountInfo $accountInfo
 * @property \Dotdigital\V2\Resources\Programs $programs
 * @property \Dotdigital\V2\Resources\Contacts $contacts
 * @property \Dotdigital\V2\Resources\AddressBooks $addressBooks
 * @property \Dotdigital\V2\Resources\DataFields $dataFields
 */
class Client extends AbstractClient
{
    public const API_VERSION_V2 = 'v2';

    /**
     * @return string
     */
    public function getApiEndpoint()
    {
        return parent::$apiEndpoint . '/' . self::API_VERSION_V2;
    }

    /**
     * @param $response
     * @return string
     * @throws \Dotdigital\Exception\ResponseValidationException
     */
    public function mediateResponse($response): string
    {
        return ResponseMediator::getContent($response);
    }
}
