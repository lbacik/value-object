<?php

namespace Sushi;

interface ValidatorInterface
{
    public function validate(ValueObject $valueObject): void;
}
