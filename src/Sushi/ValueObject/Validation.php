<?php

declare(strict_types=1);

namespace Sushi\ValueObject;

trait Validation
{
    protected array $validators = [];
    private ?ValidatorList $validatorList = null;

    private function instantiateValidators(): void
    {
        $this->validatorList = ValidatorList::create();

        foreach ($this->validators as $validatorClass) {
            $this->validatorList->addValidatorClass($validatorClass);
        }
    }

    protected function validate(): void
    {
        foreach ($this->validatorList as $validator) {
            $validator->validate($this);
        }
    }
}
