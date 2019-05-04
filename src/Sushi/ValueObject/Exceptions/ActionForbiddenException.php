<?php

declare(strict_types=1);

namespace Sushi\ValueObject\Exceptions;

class ActionForbiddenException extends \RuntimeException
{
    public static function create(): self
    {
        return new static('This action has been blocked in ValueObject context');
    }
}
