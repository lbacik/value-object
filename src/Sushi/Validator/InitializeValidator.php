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
        array_walk(
            $valueObject->getKeys(),
            function ($item) use ($valueObject) {
                if (!$valueObject->offsetExists($item)) {
                    throw NotInitializedKeyException::key($item);
                }
            }
        );
    }
}
