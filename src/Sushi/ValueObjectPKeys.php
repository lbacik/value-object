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

    public function __construct(...$values)
    {
        parent::__construct($values);
    }
}
