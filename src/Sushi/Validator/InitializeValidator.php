<?php

declare(strict_types=1);

namespace Sushi\Validator;

use Sushi\Validator\Exceptions\NotInitializedKeyException;
use Sushi\ValidatorInterface;
use Sushi\ValueObject;

class InitializeValidator implements ValidatorInterface
{
    public function validate(ValueObject $valueObject): void
    {
        foreach ($valueObject->getKeys() as $item) {
            if ($valueObject->offsetExists($item) === false) {
                throw NotInitializedKeyException::key($item);
            }
        }
    }
}
