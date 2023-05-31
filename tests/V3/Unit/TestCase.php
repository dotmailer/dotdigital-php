<?php

namespace Dotdigital\Tests\V3\Unit;

use Dotdigital\Resources\AbstractResource;
use Dotdigital\V3\Client;
use Http\Client\Common\HttpMethodsClientInterface;
use Psr\Http\Message\ResponseInterface;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Client|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $clientMock;

    /**
     * @var AbstractResource|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $abstractResourceMock;

    /**
     * @var HttpMethodsClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $httpMethodsClientMock;

    /**
     * @var ResponseInterface|\PHPUnit\Framework\MockObject\MockObject)
     */
    protected $responseInterfaceMock;

    public function setUp(): void
    {
        $this->clientMock = $this->createMock(Client::class);
        $this->abstractResourceMock = $this->getMockBuilder(AbstractResource::class)
            ->onlyMethods(['post', 'put', 'get'])
            ->setConstructorArgs([$this->clientMock])
            ->getMock();
        $this->httpMethodsClientMock = $this->createMock(HttpMethodsClientInterface::class);
        $this->responseInterfaceMock = $this->createMock(ResponseInterface::class);

        $this->setUpCommonApiMethods();
    }

    protected function setUpCommonApiMethods()
    {
        $this->clientMock->expects($this->any())
            ->method('getHttpClient')
            ->willReturn($this->httpMethodsClientMock);

        $this->httpMethodsClientMock->method('post')
            ->willReturn($this->responseInterfaceMock);

        $this->httpMethodsClientMock->method('get')
            ->willReturn($this->responseInterfaceMock);

        $this->httpMethodsClientMock->method('put')
            ->willReturn($this->responseInterfaceMock);
    }
}
