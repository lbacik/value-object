<?php

declare(strict_types=1);

namespace Sushi;

use Sushi\Validator\InitializeValidator;
use Sushi\Validator\KeysValidator;

class ValueObjectPKeys extends ValueObject
{
    protected array $validators = [
        KeysValidator::class,
        InitializeValidator::class,
    ];

    public static function create(...$values): static
    {
        return new static($values);
    }
}
