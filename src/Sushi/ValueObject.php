<?php

declare(strict_types=1);

namespace Sushi;

use Sushi\ValueObject\{
    Exceptions\ValueObjectException,
    Fields,
    Invariants,
    Comparison
};

class ValueObject extends Fields
{
    use Comparison;
    use Invariants;

    public function __construct()
    {
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
        $values = $this->getValues();
        $keys = array_keys($values);

        foreach ($data as $key => $value) {
            if (!in_array($key, $keys)) {
                throw ValueObjectException::fieldNotFound($key);
            }
            $values[$key] = $value;
        }

        return new static(...$values);
    }
}
