<?php

declare(strict_types=1);

namespace Sushi\ValueObject\Exceptions;

class NotExistingKeyException extends \RuntimeException
{
    static function key(string $key): NotExistingKeyException
    {
        return new static('Trying to access non existing key: ' . $key);
    }
}
