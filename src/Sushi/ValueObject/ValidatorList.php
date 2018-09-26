<?php

declare(strict_types=1);

namespace Sushi\ValueObject;

use Sushi\ValidatorInterface;
use Sushi\ValueObject\ValidatorList\Exceptions\NotAValidatorException;
use Sushi\ValueObject\ValidatorList\Iterator;

class ValidatorList extends Iterator
{
    public function addValidatorClass(string $validatorClass): void
    {
        $validator = new $validatorClass();

        if (!($validator instanceof ValidatorInterface)) {
            throw NotAValidatorException::create($validatorClass);
        }

        $this->elements[] = $validator;
    }

    public static function create(): ValidatorList
    {
        return new self();
    }
}
