<?php

declare(strict_types=1);

namespace Sushi;

use Sushi\ValueObject\{
    Validation,
    Comparison,
    Fields
};

class ValueObject extends Fields
{
    use Comparison;
    use Validation;

    public function __construct(array $values)
    {
        $this->instantiateValidators();
        $this->setValues($values);
        $this->validate();
    }

    public function isEqual(ValueObject $other): bool
    {
        $result = true;
        $a = $this->getValues();
        $b = $other->getValues();

        foreach ($a as $key => $item) {
            if (isset($b[$key]) === false || $this->compare($item, $b[$key]) === false) {
                $result = false;
                break;
            }
            unset($a[$key], $b[$key]);
        }

        return $result === true ? count($b) === 0 : $result;
    }

    public function set(array $data): ValueObject
    {
        $clone = clone $this;
        $clone->setValues(array_merge($this->getValues(), $data));
        $clone->validate();

        return $clone;
    }
}
