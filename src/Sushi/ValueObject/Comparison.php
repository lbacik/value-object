<?php

declare(strict_types=1);

namespace Sushi\ValueObject;

use Sushi\ValueObject;

trait Comparison
{
    /**
     * @param mixed $a
     * @param mixed $b
     */
    protected function compare($a, $b): bool
    {
        if ($a instanceof ValueObject && $b instanceof ValueObject) {
            $result = $a->isEqual($b);
        } else {
            $this->ifArrayThenSortArrayKeys($a);
            $this->ifArrayThenSortArrayKeys($b);

            $result = $a === $b;
        }

        return $result;
    }

    /**
     * @param mixed $value
     */
    private function ifArrayThenSortArrayKeys(&$value): void
    {
        if (is_array($value)) {
            ksort($value);
        }
    }
}
