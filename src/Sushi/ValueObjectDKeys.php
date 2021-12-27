<?php

declare(strict_types=1);

namespace Sushi;

class ValueObjectDKeys extends ValueObject
{
    public function __construct(...$values)
    {
        $this->keys = array_keys($values);
        parent::__construct($values);
    }
}
