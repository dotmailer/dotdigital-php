<?php

declare(strict_types=1);

namespace Dotdigital;

use Dotdigital\Resources\ResourceFactory;
use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\AuthenticationPlugin;
use Http\Client\Common\Plugin\BaseUriPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Message\Authentication\BasicAuth;
use Http\Message\UriFactory;

/**
 * @property Resources\AccountInfo $accountInfo
 * @property Resources\Programs $programs
 * @property Resources\Contacts $contact
 * @property Resources\AddressBooks $addressBooks
 * @property Resources\DataFields $dataFields
 */
class Client
{
    public const API_VERSION = 'v2';

    /**
     * @var ClientBuilder
     */
    private $clientBuilder;

    /**
     * @var UriFactory|\Psr\Http\Message\UriFactoryInterface
     */
    private $uriFactory;

    /**
     * @var ResourceFactory
     */
    private $resourceFactory;

    /**
     * @var string
     */
    public static $apiEndpoint;

    /**
     * @var string
     */
    public static $apiUser;

    /**
     * @var string
     */
    public static $apiPassword;

    public function __construct(
        ClientBuilder $clientBuilder = null,
        UriFactory $uriFactory = null
    ) {
        $this->clientBuilder = $clientBuilder ?: new ClientBuilder();
        $this->uriFactory = $uriFactory ?: Psr17FactoryDiscovery::findUriFactory();

        // Set default headers
        $this->clientBuilder->addPlugin(
            new HeaderDefaultsPlugin(
                [
                    'User-Agent' => 'dotdigital-php',
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]
            )
        );
    }

    /**
     * @param string $email
     *
     * @return void
     */
    public static function setApiUser(string $email)
    {
        self::$apiUser = $email;
    }

    /**
     * @param string $password
     *
     * @return void
     */
    public static function setApiPassword(string $password)
    {
        self::$apiPassword = $password;
    }

    /**
     * @param string $endpoint
     *
     * @return void
     */
    public static function setApiEndpoint(string $endpoint)
    {
        self::$apiEndpoint = $endpoint;
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        // Set base uri
        $this->clientBuilder->addPlugin(
            new BaseUriPlugin($this->uriFactory->createUri(
                self::$apiEndpoint . '/' . self::API_VERSION
            ))
        );

        $this->clientBuilder->addPlugin(
            new AuthenticationPlugin(
                new BasicAuth(self::$apiUser, self::$apiPassword)
            )
        );
        return $this->clientBuilder->getHttpClient();
    }

    /**
     * @param string $name
     *
     * @return Resources\AbstractResource|null
     */
    public function __get($name)
    {
        if (null === $this->resourceFactory) {
            $this->resourceFactory = new Resources\ResourceFactory($this);
        }

        return $this->resourceFactory->__get($name);
    }
}
