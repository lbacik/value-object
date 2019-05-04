<?php

declare(strict_types=1);

namespace Sushi\ValueObject;

class Fields extends ArrayAccess
{
    protected $keys = [];

    public function toArray(): array
    {
        return array_reduce(
            array_merge($this->getKeys(), array_keys($this->getValues())),
            function ($result, $item) {
                $result[$item] = $this[$item];
                return $result;
            },
            []
        );
    }

    public function getKeys(): array
    {
        if ($this->isAssociative($this->keys)) {
            return array_keys($this->keys);
        }
        return $this->keys;
    }

    private function isAssociative(array $arr): bool
    {
        foreach ($arr as $key => $value) {
            if (is_string($key)) {
                return true;
            }
        }
        return false;
    }
}
