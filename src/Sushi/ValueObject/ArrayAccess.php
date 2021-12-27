<?php

declare(strict_types=1);

namespace Sushi\ValueObject;

use Sushi\ValueObject\Exceptions\ActionForbiddenException;

class ArrayAccess implements \ArrayAccess
{
    private array $values = [];

    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->values);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->values[$offset] ?? null;
    }

    public function offsetSet($offset, $value): void
    {
        throw ActionForbiddenException::create();
    }

    public function offsetUnset($offset): void
    {
        throw ActionForbiddenException::create();
    }

    protected function getValues(): array
    {
        return $this->values;
    }

    protected function setValues(array $values): void
    {
        $this->values = $values;
    }
}
