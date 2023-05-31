<?php

declare(strict_types=1);

namespace Dotdigital\Models;

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
