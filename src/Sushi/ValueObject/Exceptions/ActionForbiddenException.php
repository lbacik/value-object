<?php

declare(strict_types=1);

namespace Sushi\ValueObject\Exceptions;

class ActionForbiddenException extends \RuntimeException
{
    static function create(): ActionForbiddenException
    {
        return new static('This action is denied in ValueObject context');
    }
}