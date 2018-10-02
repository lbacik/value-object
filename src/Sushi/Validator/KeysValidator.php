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
        $declaredKeys = $valueObject->getKeys();
        $keys = array_keys($valueObject->toArray());

        foreach($keys as $item) {
            if (!in_array($item, $declaredKeys)) {
                throw NotExistingKeyException::key($item);
            }
        }
    }
}
