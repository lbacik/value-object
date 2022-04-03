<?php

declare(strict_types=1);

namespace Sushi\ValueObject;

use ReflectionObject;

class Fields
{
    protected function getValues(): array
    {
        $result = [];
        $reflection = new ReflectionObject($this);
        foreach ($reflection->getProperties() as $property) {
            $result[$property->getName()] = $property->getValue($this);
        }
        return $result;
    }
}
