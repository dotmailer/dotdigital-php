<?php

declare(strict_types=1);

namespace Dotdigital\Models;

use Dotdigital\Exception\ResponseValidationException;

abstract class AbstractModel
{
    /**
     * @param string|array<mixed> $content
     *
     * @return void
     * @throws \Exception
     */
    abstract protected function validate($content);
}
