<?php

declare(strict_types=1);

namespace Sushi\ValueObject\ValidatorList;

class Iterator implements \Iterator
{
    private int $position = 0;

    protected array $elements = [];

    public function current(): mixed
    {
        return $this->elements[$this->position];
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->elements[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function next(): void
    {
        ++$this->position;
    }
}
