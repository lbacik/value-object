<?php

declare(strict_types=1);

namespace Sushi\Validator;

use Sushi\Validator\Exceptions\NotExistingKeyException;
use Sushi\ValidatorInterface;
use Sushi\ValueObject;

class KeysValidator implements ValidatorInterface
{
    public function validate(ValueObject $valueObject): void
    {
        $keys = $valueObject->getKeys();

        array_walk(
            array_keys($valueObject->toArray()),
            function ($item) use ($keys) {
                if (!in_array($item, $keys)) {
                    throw NotExistingKeyException::key($item);
                }
            }
        );
    }
}
