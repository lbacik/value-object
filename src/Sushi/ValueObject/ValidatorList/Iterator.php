<?php

declare(strict_types=1);

namespace Sushi\ValueObject\ValidatorList;

class Iterator implements \Iterator
{
    private $position = 0;

    protected $elements = [];

    /**
     * @return mixed
     */
    public function current()
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

    public function rewind()
    {
        $this->position = 0;
    }

    public function next()
    {
        ++$this->position;
    }
}
