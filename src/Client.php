<?php

declare(strict_types=1);

namespace Dotdigital;

use Dotdigital\Resource\ResourceFactory;
use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\BaseUriPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\AuthenticationPlugin;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Message\Authentication\BasicAuth;
use Http\Message\UriFactory;

class Client
{
	const API_VERSION = 'v2';

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

	public static $apiEndpoint;

	public static $apiUser;

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

	public static function setApiUser(string $email)
	{
		self::$apiUser = $email;
	}

	public static function setApiPassword(string $password)
	{
		self::$apiPassword = $password;
	}

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

	public function __get($name)
	{
		if (null === $this->resourceFactory) {
			$this->resourceFactory = new Resource\ResourceFactory($this);
		}

		return $this->resourceFactory->__get($name);
	}
}
