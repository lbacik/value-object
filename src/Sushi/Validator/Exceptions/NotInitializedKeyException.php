<?php

declare(strict_types=1);

namespace Sushi\Validator\Exceptions;

class NotInitializedKeyException extends \RuntimeException
{
    public static function key(string $key): self
    {
        return new static('Not initialised key: ' . $key);
    }
}
