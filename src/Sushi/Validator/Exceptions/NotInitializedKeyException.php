<?php

declare(strict_types=1);

namespace Sushi\Validator\Exceptions;

class NotInitializedKeyException extends \RuntimeException
{
    static function key(string $key): NotInitializedKeyException
    {
        return new static('Not initialised key: ' . $key);
    }
}
