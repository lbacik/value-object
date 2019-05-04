<?php

declare(strict_types=1);

namespace Sushi\Validator\Exceptions;

class NotExistingKeyException extends \RuntimeException
{
    public static function key(string $key): self
    {
        return new static('Trying to set non defined key: ' . $key);
    }
}
