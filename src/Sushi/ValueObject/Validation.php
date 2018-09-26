<?php

declare(strict_types=1);

namespace Sushi\ValueObject;

class Validation extends Fields
{
    protected $validators = [];

    /** @var ValidatorList */
    private $validatorList = null;

    public function __construct()
    {
        $this->instantiateValidators();
    }

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
