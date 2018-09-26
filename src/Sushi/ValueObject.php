<?php

declare(strict_types=1);

namespace Sushi;

use Sushi\ValueObject\Validation;

class ValueObject extends Validation
{
    public function __construct(array $values)
    {
        parent::__construct();
        $this->setValues($values);
        $this->validate();
    }

    public function equal(ValueObject $other): bool
    {
        $result = array_diff(
            $this->toArray(),
            $other->toArray()
        );

        return count($result) === 0 ? true : false;
    }

    public function set(array $data): ValueObject
    {
        $clone = clone $this;
        $clone->setValues(array_merge($this->toArray(), $data));
        $clone->validate();

        return $clone;
    }
}
