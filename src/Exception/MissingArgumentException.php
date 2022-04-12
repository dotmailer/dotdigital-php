<?php

namespace Dotdigital\Exception;

class MissingArgumentException extends \ErrorException implements ExceptionInterface
{
    /**
     * @param string|array<string>   $required
     */
    public function __construct($required)
    {
        if (is_string($required)) {
            $required = [$required];
        }

        parent::__construct(sprintf('Missing argument(s): "%s".', implode('", "', $required)));
    }
}
