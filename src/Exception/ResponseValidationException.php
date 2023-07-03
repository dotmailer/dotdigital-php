<?php

namespace Dotdigital\Exception;

use Psr\Http\Message\ResponseInterface;

class ResponseValidationException extends \ErrorException implements ExceptionInterface
{
    /**
     * @var array
     */
    private $details;

    /**
     * @param ResponseInterface $errorResponse
     * @return ResponseValidationException
     */
    public static function fromErrorResponse(
        ResponseInterface $errorResponse
    ): ResponseValidationException {
        $content = $errorResponse->getBody()->getContents();
        $status = $errorResponse->getStatusCode();
        $exception = new self($content, $status);
        $exception->setDetails($content);
        $exception->setMessage($content);
        return $exception;
    }

    /**
     * @return array
     */
    public function getDetails(): ?array
    {
        return $this->details;
    }

    /**
     * @param $errorResponse
     * @return void
     */
    public function setDetails($errorResponse)
    {
        $errorData = $this->decodeResponse($errorResponse);
        $this->details = $errorData['details'] ?? [];
    }

    /**
     * @param string $responseBody
     * @return void
     */
    public function setMessage(string $responseBody): void
    {
        $decoded = $this->decodeResponse($responseBody);
        $this->message = sprintf(
            '%s - %s',
            $decoded['errorCode'],
            $decoded['description']
        );
    }

    /**
     * @param $responseBody
     * @return mixed|string[]
     */
    private function decodeResponse($responseBody)
    {
        $decoded = json_decode($responseBody, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $decoded = [
                'description' => sprintf('Error decoding response - %s', json_last_error_msg()),
                'errorCode' => 'Error Unknown',
                'details' => [],
           ];
        }
        return $decoded;
    }
}
