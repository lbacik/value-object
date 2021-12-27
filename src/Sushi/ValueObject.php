<?php

declare(strict_types=1);

namespace Sushi;

use Sushi\ValueObject\{
    Fields,
    Invariants,
    Validation,
    Comparison
};

class ValueObject extends Fields
{
    use Comparison;
    use Validation;
    use Invariants;

    public function __construct(array $values)
    {
        $this->instantiateValidators();
        $this->setValues($values);
        $this->validate();
        $this->checkInvariants();
    }

    public function isEqual(ValueObject $other): bool
    {
        $result = true;
        $a = $this->getValues();
        $b = $other->getValues();

        foreach ($a as $key => $item) {
            if (array_key_exists($key, $b) === false || $this->compare($item, $b[$key]) === false) {
                $result = false;
                break;
            }
            unset($a[$key], $b[$key]);
        }

        return $result === true ? count($b) === 0 : $result;
    }

    public function set(...$data): ValueObject
    {
        if (count($data) === 1 && array_key_exists(0, $data) && is_array($data[0])) {
            $result = $this->setArray($data[0]);
        } else {
            $result = $this->setArray($data);
        }

        return $result;
    }

    private function setArray(array $data): ValueObject
    {
        $clone = clone $this;
        $clone->setValues(array_merge($this->getValues(), $data));
        $clone->validate();
        $clone->checkInvariants();

        return $clone;
    }

    public function get(string $key): mixed
    {
        return $this->offsetGet($key);
    }
}
