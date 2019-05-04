<?php

declare(strict_types=1);

namespace Sushi\ValueObject\ValidatorList\Exceptions;

class NotAValidatorException extends \RuntimeException
{
    public static function create(string $class): NotAValidatorException
    {
        return new static(sprintf('Class %s does not implement the ValidatorInterface', $class));
    }
}
