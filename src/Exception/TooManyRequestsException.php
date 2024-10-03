<?php

namespace Dotdigital\Exception;

use Psr\Http\Message\ResponseInterface;

class TooManyRequestsException extends \ErrorException implements ExceptionInterface
{
    /**
     * @var ?string
     */
    private $scope;

    /**
     * @var ?int
     */
    private $limit;

    /**
     * @var ?int
     */
    private $reset;

    /**
     * @param ResponseInterface $errorResponse
     * @return TooManyRequestsException
     */
    public static function fromErrorResponse(
        ResponseInterface $errorResponse
    ): TooManyRequestsException {
        $message = $errorResponse->getReasonPhrase();
        $status = $errorResponse->getStatusCode();
        $exception = new self($message, $status);
        $exception->setScope($errorResponse);
        $exception->setLimit($errorResponse);
        $exception->setReset($errorResponse);
        return $exception;
    }

    /**
     * @param ResponseInterface $errorResponse
     *
     * @return void
     */
    public function setScope($errorResponse): void
    {
        $this->scope = $errorResponse->hasHeader('x-ratelimit-scope') ?
            $errorResponse->getHeader('x-ratelimit-scope')[0] :
            null;
    }

    /**
     * @return string|null
     */
    public function getScope(): ?string
    {
        return $this->scope;
    }

    /**
     * @param ResponseInterface $errorResponse
     *
     * @return void
     */
    public function setLimit(ResponseInterface $errorResponse)
    {
        $this->limit = $errorResponse->hasHeader('x-ratelimit-limit') ?
            (int) $errorResponse->getHeader('x-ratelimit-limit')[0] :
            null;
    }

    /**
     * @return int|null
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * Set the time in seconds until the rate limit resets.
     *
     * @param ResponseInterface $errorResponse
     *
     * @return void
     */
    public function setReset(ResponseInterface $errorResponse)
    {
        $this->reset = $errorResponse->hasHeader('x-ratelimit-reset') ?
            (int) $errorResponse->getHeader('x-ratelimit-reset')[0] :
            null;
    }

    /**
     * @return int|null
     */
    public function getReset(): ?int
    {
        return $this->reset;
    }
}
