<?php

declare(strict_types=1);

namespace Sushi;

use Sushi\ValueObject\Comparison;

class ValueObject extends Comparison
{
    public function __construct(array $values)
    {
        parent::__construct();
        $this->setValues($values);
        $this->validate();
    }

    public function isEqual(ValueObject $other): bool
    {
        $result = true;
        $a = $this->toArray();
        $b = $other->toArray();

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
        $clone->setValues(array_merge($this->toArray(), $data));
        $clone->validate();

        return $clone;
    }
}
