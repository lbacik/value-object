<?php

declare(strict_types=1);

namespace Sushi\Validator\Exceptions;

class NotExistingKeyException extends \RuntimeException
{
    static function key(string $key): NotExistingKeyException
    {
        return new static('Trying to set non defined key: ' . $key);
    }
}
